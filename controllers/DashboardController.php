<?php 

namespace Controllers;

use MVC\Router;
use Model\Usuario;
use Model\Proyecto;

class DashboardController {
    public static function index(Router $router) {
        session_start();
        isAuth();

        $id = $_SESSION['id'];
        $proyectos = Proyecto::belongsTo('propietarioId', $id);

        $router->render('dashboard/index', [
            'title' => 'Projects',
            'proyectos' => $proyectos
        ]);
    }

    public static function create_projects(Router $router) {
        session_start();
        isAuth();

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $proyecto = new Proyecto($_POST);

            //validacion 
            $alertas = $proyecto->validarProyecto();

            if(empty($alertas)) {
                //Generar una url unica
                $hash = md5(uniqid()); //genera un url unico para cada user
                $proyecto->url = $hash;

                //Almacenar el creador del proyecto
                $proyecto->propietarioId = $_SESSION['id'];

                //Guardar el proyecto
                $proyecto->guardar();

                //Redireccionar
                header('Location: /project?id=' . $proyecto->url);
            }

        }

        $router->render('dashboard/create-projects', [
            'title' => 'Create Projects',
            'alertas' => $alertas
        ]);
    }

    public static function project(Router $router) {
        session_start();
        isAuth();

        $token = $_GET['id'];

        if(!$token) header('Location: /dashboard');

        //Revisar que si sea el propietario del proyecto
        $proyecto = Proyecto::where('url', $token);

        if($proyecto->propietarioId !== $_SESSION['id']) {
            header('Location: /dashboard');
        }

        $router->render('dashboard/project', [
        'title' => $proyecto->proyecto //muestra el nombre que tiene el proyecto
        ]);
    }

    public static function profile(Router $router) {
        session_start();
        isAuth();
        $alertas = [];

        $usuario = Usuario::find($_SESSION['id']);

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);

            $alertas = $usuario->validar_perfil();

            if(empty($alertas)) {

                $existeUsuario = Usuario::where('email', $usuario->email);
                
                if($existeUsuario && $existeUsuario->id !== $usuario->id) {
                    //mostrar msj de error si ya existe ese email
                    Usuario::setAlerta('error', 'Email already registered');
                    $alertas = $usuario->getAlertas();
                
                } else {
                    //guardar el usuario
                    $usuario->guardar();

                    Usuario::setAlerta('exito', 'Properly saved');
                    $alertas = $usuario->getAlertas();

                    //asignar el nombre nuevo
                    $_SESSION['nombre'] = $usuario->nombre;
                }
            }
        }

        $router->render('dashboard/profile', [
            'title' => 'Profile',
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function cambiar_password(Router $router) {
        session_start();
        isAuth();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = Usuario::find($_SESSION['id']);

            //sincronizar con los datos del usuaario
            $usuario->sincronizar($_POST);
            $alerta = $usuario->nuevo_password();

            if(empty($alertas)){
                $resultado = $usuario->comprobar_password(); 

                if($resultado) {
                    //Asignar el nuevo password
                    $usuario->password = $usuario->password_nuevo;

                    //Eliminar propiedades no necesarias
                    unset($usuario->password_actual);
                    unset($usuario->password_nuevo);


                    //Hasharr el nuevo password
                    $usuario->hashPassword();

                    //actualizar el pass
                    $resultado = $usuario->guardar();

                    if($resultado) {
                        Usuario::setAlerta('exito', 'Password saved');
                        $alertas = $usuario->getAlertas();
                    }


                } else {
                    Usuario::setAlerta('error', 'Incorrect Password');
                    $alertas = $usuario->getAlertas();
                }
            }
        }

        $router->render('dashboard/cambiar-password', [
            'titulo' => 'Change Password',
            'alertas' => $alertas
        ]);

    }

}