<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Clients\ClientController;
use App\Controllers\Clients\TransactionController;

/**
 * @var RouteCollection $routes
 */
$routes->get("/", "Home::index");
$routes->group("clients", function ($routes) {
    $routes->get("/", [ClientController::class, "index"]);
    $routes->post("login", [ClientController::class, "login"]);
    $routes->get("logout", [ClientController::class, "logout"]);
    $routes->get("dashboard", [ClientController::class, "dashboard"]);

    $routes->group("transaction", function ($routes) {
        $routes->get("/", [TransactionController::class, "index"]);
        $routes->post("validate", [TransactionController::class, "store"]);
    });
});
