<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Clients\ClientController;
use App\Controllers\Transaction\TransactionController;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->group("clients", function ($routes) {
    $routes->get("/", [ClientController::class, "index"]);
    $routes->post("login", [ClientController::class, "login"]);
    $routes->get("logout", [ClientController::class, "logout"]);
    $routes->get("dashboard", [ClientController::class, "dashboard"]);
    $routes->get("solde/(:num)", [ClientController::class, "solde/$1"]);

    $routes->group("transaction", function ($routes) {
        $routes->get("/", [TransactionController::class, "index"]);
        $routes->post("validate", [TransactionController::class, "store"]);
    });
});


$routes->group('operateurs', function ($routes) {

    $routes->get('/', 'Operateurs\OperateursController::dashboard');

    $routes->group('operateurs', function ($routes) {
        $routes->get('/', 'Operateurs\OperateursController::index');

        $routes->get('create', 'Operateurs\OperateursController::create');
        $routes->post('insert', 'Operateurs\OperateursController::insert');

        $routes->get('edit/(:num)', 'Operateurs\OperateursController::edit/$1');
        $routes->post('update/(:num)', 'Operateurs\OperateursController::update/$1');

        $routes->get('delete/(:num)', 'Operateurs\OperateursController::delete/$1');
    });

    $routes->group('prefixes', function ($routes) {
        $routes->get('/', 'Operateurs\PrefixesController::index');

        $routes->get('create', 'Operateurs\PrefixesController::create');
        $routes->post('insert', 'Operateurs\PrefixesController::insert');

        $routes->get('edit/(:num)', 'Operateurs\PrefixesController::edit/$1');
        $routes->post('update/(:num)', 'Operateurs\PrefixesController::update/$1');

        $routes->get('delete/(:num)', 'Operateurs\PrefixesController::delete/$1');
    });

    $routes->group('types-operation', function ($routes) {
        $routes->get('/', 'Operateurs\TypesOperationController::index');

        $routes->get('create', 'Operateurs\TypesOperationController::create');
        $routes->post('insert', 'Operateurs\TypesOperationController::insert');

        $routes->get('edit/(:num)', 'Operateurs\TypesOperationController::edit/$1');
        $routes->post('update/(:num)', 'Operateurs\TypesOperationController::update/$1');

        $routes->get('delete/(:num)', 'Operateurs\TypesOperationController::delete/$1');
    });

    $routes->group('baremes', function ($routes) {
        $routes->get('/', 'Operateurs\BaremesController::index');

        $routes->get('create', 'Operateurs\BaremesController::create');
        $routes->post('insert', 'Operateurs\BaremesController::insert');

        $routes->get('edit/(:num)', 'Operateurs\BaremesController::edit/$1');
        $routes->post('update/(:num)', 'Operateurs\BaremesController::update/$1');

        $routes->get('delete/(:num)', 'Operateurs\BaremesController::delete/$1');
    });
});
