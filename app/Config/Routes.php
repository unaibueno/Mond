<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/', 'LandingController::index');
$routes->get('/tareas', 'TareasController::index');
$routes->get('/temporizador', 'TemporizadoresController::index');
