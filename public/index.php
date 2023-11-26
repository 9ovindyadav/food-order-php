<?php

declare(strict_types = 1);

require __DIR__.'/../vendor/autoload.php';	

define('VIEW_PATH', __DIR__.'/../views');
// session_start();

$router = new App\Router() ;

$router->get('/', [App\Controllers\HomeController::class, 'index'])
		->get('/login', [App\Controllers\LoginController::class, 'index'])
        ->post('/login/auth', [App\Controllers\LoginController::class, 'login']);

echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));