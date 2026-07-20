<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Clients\ClientController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group("clients", function ($routes) {
    $routes->get('/', [ClientController::class, 'index']);
    $routes->post('login', [ClientController::class, 'login']);
    $routes->get('logout', [ClientController::class, 'logout']);
});
