<?php

declare(strict_types = 1);

use App\App ;
use App\Router ;
use App\Config ;
use App\Controllers\LoginController ;
use App\Controllers\OrderController ;

require __DIR__.'/../vendor/autoload.php';	

$filePath = __DIR__.'/../.env';

if(file_exists($filePath))
{
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach($lines as $line)
    {
        list($name, $value) = explode('=', $line, 2);
        $_ENV[$name] = $value ;
    }
}

define('VIEW_PATH', __DIR__.'/');
session_start();

$router = new Router() ;

    $router->get('/login', [LoginController::class, 'index'])
            ->post('/login', [LoginController::class, 'login'])
            ->get('/', [OrderController::class, 'index'])
            ->post('/order/create', [OrderController::class, 'createOrder']);


(new App(
    $router,
    ['uri'=> $_SERVER['REQUEST_URI'],'method'=> $_SERVER['REQUEST_METHOD']],
    new Config($_ENV),
))
->run();