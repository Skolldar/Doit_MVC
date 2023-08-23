<?php 

namespace Controllers;

use MVC\Router;
use Model\Proyecto;

class DashboardController {
    public static function index(Router $router) {
        session_start();
        isAuth();

        $id = $_SESSION['id'];
        $proyectos = Proyecto::where('propietarioId', $id);

        $router->render('dashboard/index', [
            'title' => 'Projects'
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


        $router->render('dashboard/profile', [
            'title' => 'Profile'
        ]);
    }


}