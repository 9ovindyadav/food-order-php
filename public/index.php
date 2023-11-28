<?php

declare(strict_types = 1);

use App\App ;
use App\Router ;
use App\Config ;
use App\Controllers\LoginController ;
use App\Controllers\OrderController ;

require __DIR__.'/../vendor/autoload.php';	

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

define('VIEW_PATH', __DIR__.'/');
// session_start();

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