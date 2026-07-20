<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Clients\ClientController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/clients', [ClientController::class, 'index']);
