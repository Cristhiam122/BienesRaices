<?php

use MVC\Router;
use Controllers\PropiedadController;

require_once __DIR__ . '/../includes/app.php';

$router = new Router;

$router->get('/admin', [PropiedadController::class, 'index']);
$router->get('/propiedades/crear', [PropiedadController::class, 'create']);
$router->get('/update', [PropiedadController::class, 'update']);

$router->comprobarRutas();