<?php 

namespace Controllers;
use MVC\Router;
use Classes\Email;
use Model\Usuario;

class LoginController {
    public static function login(Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);

            $alertas = $usuario->validarLogin();

            if(empty($alertas)) {
                //Verificar que el usuario exista
                    $usuario = Usuario::where('email', $usuario->email);

                    if(!$usuario || !$usuario->confirmado) {
                        Usuario::setAlerta('error', 'The user does not exist or its not confirmed');
                    } else {
                        //El usuario existe
                        if(password_verify($_POST['password'], $usuario->password)) {
                            //inisiar session
                            session_start();
                            $_SESSION['id'] = $usuario->id;
                            $_SESSION['nombre'] = $usuario->nombre;
                            $_SESSION['email'] = $usuario->email;
                            $_SESSION['login'] = true;

                            //Redireccionar a proyectos
                            header('Location: /dashboard');
                        } else {
                            Usuario::setAlerta('error', 'Password incorred');

                        }
                    }

            }
        }

        $alertas = Usuario::getAlertas();
        // Render to the view
        $router->render('auth/login', [
            'title' => 'Log In',
            'alertas' => $alertas 

        ]);
    }

////////// LOG OUT ////////////
    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

/////////////// CREAR ////////////////
    public static function create(Router $router) {

        $alertas = [];
        $usuario = new Usuario;
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();
    
            if(empty($alertas)){
                $existeUsuario = Usuario::where('email', $usuario->email);

                if($existeUsuario) {
                    Usuario::setAlerta('error', 'The user is already registred');
                    $alertass = Usuario::getAlertas();
                } else {
                    //Hashear password
                    $usuario->hashPassword();

                    //Eliminar password2 //UNSET() permite eliminar un elemento
                    unset($usuario->password2);

                    //Generar el Token
                    $usuario->crearToken();

                    //Crear un nuevo usuario
                    $resultado = $usuario->guardar();

                    //Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmation();

                    if($resultado) {
                        header('Location: /message');
                    }
                }
            }

        }

        // Render to the view
        $router->render('auth/create', [
            'title' => 'Create your account',
            'usuario' => $usuario,
            'alertas' => $alertas 
        ]);
    } 

//////////////////////// OLVIDE /////////////
    public static function forget(Router $router) {
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarEmail();

            if(empty($alertas)) {
                //Buscar el user
                $usuario = Usuario::where('email', $usuario->email);

                //Encontre al usuario
                if($usuario && $usuario->confirmado) {
                    //Generar un nuevo token
                    $usuario->crearToken();
                    unset($usuario->password2);

                    //Acutalizar el usuario
                    $usuario->guardar();

                    //Enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();



                    //Imprimir la alerta
                    Usuario::setAlerta('exito', 'We have sent the instructions to your email');
                } else {
                    Usuario::setAlerta('error', 'The user does not exist or is not confirmed');
                }

            }
        }

        $alertas = Usuario::getAlertas();

        // Render to the view
        $router->render('auth/forget', [
            'title' => 'Forget my password',
            'alertas' => $alertas
        ]);
    } 

////////////////////////// reset ////////////

    public static function reset(Router $router) {
        $token = s($_GET['token']);
        $mostrar = true;

        if(!$token) header('Location: /');

        //Identificar el usuario con este Token 
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            Usuario::setAlerta('eror', 'Token no validate');
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Anadir nuevo password
            $usuario->sincronizar($_POST);

            //Validar el password

            $alertas = $usuario->validarPassword();

            if(empty($alertas)) {
                //Hasshear el nuevo password
                $usuario->hashPassword();

                //Eliminar el token
                $usuario->token= null;

                //Guardar el usuario en la DB
                $resultado = $usuario->guardar();

                //Redireccionar
                if($resultado) {
                    header('Location: /');
                }
            }

        }

        $alertas = Usuario::getAlertas();
        // Render to the view
        $router->render('auth/reset', [
            'title' => 'Reset my password',
            'alertas' => $alertas,
            'mostrar' => $mostrar
        ]);
    } 

///////////////////// message
    public static function message(Router $router) {

        // Render to the view
        $router->render('auth/message', [
            'title' => 'Account successfully created'
        ]);
    } 

///////////////////// confirmation
    public static function confirmation(Router $router) {
        $token = s($_GET['token']);

        if(!$token) header('Location: /');

        //Encontrar el user con este TOKEN
        $usuario = Usuario::where('token', $token);

        if(empty($usuario)) {
            //no se encontro un usuario con un token valido
            Usuario::setAlerta('error', 'Token no valied');
        } else {
            //confirmar la cuenta
             $usuario->confirmado = 1;
             $usuario->token = null;
             unset($usuario->password2);

             //Guardar en la db
             $usuario->guardar();
             Usuario::setAlerta('exito', 'Account successfully verified');
        }

        $alertas = Usuario::getAlertas();

        // Render to the view
        $router->render('auth/confirmation', [
            'title' => 'Confirm your account',
            'alertas' => $alertas
        ]);
    } 
}