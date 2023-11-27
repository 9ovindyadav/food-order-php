<?php

declare(strict_types = 1);

require __DIR__.'/../vendor/autoload.php';	

define('VIEW_PATH', __DIR__.'/');
// session_start();

$router = new App\Router() ;

$router->get('/login', [App\Controllers\LoginController::class, 'index'])
        ->post('/login', [App\Controllers\LoginController::class, 'login'])
		->get('/', [App\Controllers\OrderController::class, 'index'])
        ->post('/order/create', [App\Controllers\OrderController::class, 'createOrder']);

echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));
