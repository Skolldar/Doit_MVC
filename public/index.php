<?php 

require_once __DIR__ . '/../includes/app.php';
use MVC\Router;
use Controllers\LoginController;
use Controllers\DashboardController;
$router = new Router();

//login

$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Crear Cuenta
$router->get('/create', [LoginController::class, 'create']);
$router->post('/create', [LoginController::class, 'create']);

// Formulario de olvide mi Cuenta
$router->get('/forget', [LoginController::class, 'forget']);
$router->post('/forget', [LoginController::class, 'forget']);

//Colocar el nuevo password
$router->get('/reset', [LoginController::class, 'reset']);
$router->post('/reset', [LoginController::class, 'reset']);

//Account Confirmation
$router->get('/message', [LoginController::class, 'message']);
$router->get('/confirmation', [LoginController::class, 'confirmation']);

//Zona de proyectos
$router->get('/dashboard', [DashboardController::class, 'index']);
$router->get('/create-projects', [DashboardController::class, 'create_projects']);
$router->post('/create-projects', [DashboardController::class, 'create_projects']);
$router->get('/project', [DashboardController::class, 'project']);
$router->get('/profile', [DashboardController::class, 'profile']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();