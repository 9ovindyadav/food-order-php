<?php

declare(strict_types = 1);

require __DIR__.'/../vendor/autoload.php';	

$router = new App\Router() ;

$router->get('/', [App\Classes\Home::class, 'index'])
		->get('/login', [App\Classes\Login::class, 'index'])
        ->post('/login/auth', [App\Classes\Login::class, 'login']);

echo $router->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));