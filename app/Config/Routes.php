<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Ruta para acceso no autorizado
$routes->get('/unauthorized', function () {
    return view('errors/html/unauthorized');
});

// Ruta a la landing page
$routes->get('/', function () {
    return view('landing-page');
});
// Rutas de autenticación y registro
$routes->get('auth/login', 'AuthController::login', ['as' => 'login']);
$routes->post('auth/dologin', 'AuthController::do_login');
$routes->get('auth/logout', 'AuthController::logout');

$routes->get('auth/register', 'AuthController::register');
$routes->post('auth/do_register', 'AuthController::do_register');

// Define las rutas protegidas por el filtro de roles (rol 0 para usuarios normales)
$routes->group('', ['filter' => 'role:0'], function ($routes) {

    $routes->get('/dashboard', 'Dashboard::index');

    $routes->get('tareas', 'TareasController::index');
    $routes->get('pomodoro', 'PomodoroController::index');
    $routes->get('calendario', 'CalendarioController::index');
    $routes->get('notas', 'NotasController::index');

    $routes->post('save-event', 'CalendarioController::saveEvent');
    $routes->post('update-event', 'CalendarioController::updateEvent');
    $routes->post('delete-event', 'CalendarioController::deleteEvent');
    $routes->get('get-events', 'CalendarioController::getEvents');

    $routes->post('/notas/saveTitle', 'NotasController::saveTitle');
    $routes->post('/notas/saveContent', 'NotasController::saveContent');
    $routes->post('/notas/delete/(:num)', 'NotasController::delete/$1');
    $routes->get('/notas/getNote/(:num)', 'NotasController::getNote/$1');

    $routes->post('tareas/save', 'TareasController::save');
    $routes->post('tareas/update', 'TareasController::update');
    $routes->post('tareas/delete', 'TareasController::delete');
    $routes->post('tareas/updateState', 'TareasController::updateState');
    $routes->get('tareas/progreso', 'TareasController::getTaskProgress');

    $routes->get('/tasks', 'Dashboard::getTasks');
    $routes->get('/notes', 'Dashboard::getNotes');
    $routes->get('user', 'UsersController::getUser');
    $routes->post('user/update', 'UsersController::updateUser');

});

