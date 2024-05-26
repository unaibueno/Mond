<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/', 'LandingController::index');
$routes->get('tareas', 'TareasController::index');
$routes->get('temporizador', 'TemporizadoresController::index');
$routes->get('calendario', 'CalendarioController::index');
$routes->get('notas', 'NotasController::index');

$routes->post('save-event', 'CalendarioController::saveEvent');
$routes->post('update-event', 'CalendarioController::updateEvent'); // Ruta para actualizar eventos
$routes->post('delete-event', 'CalendarioController::deleteEvent'); // Ruta para eliminar eventos
$routes->get('get-events', 'CalendarioController::getEvents');


$routes->post('/notas/saveTitle', 'NotasController::saveTitle');
$routes->post('/notas/saveContent', 'NotasController::saveContent');
$routes->post('/notas/delete/(:num)', 'NotasController::delete/$1');
$routes->get('/notas/getNote/(:num)', 'NotasController::getNote/$1');
