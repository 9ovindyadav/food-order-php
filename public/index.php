<?php

declare(strict_types = 1);

use App\App ;
use App\Router ;
use App\Config ;
use App\Controllers\LoginController ;
use App\Controllers\OrderController ;
use App\Controllers\AdminController ;

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

$authMuddleware = function () {
    $currentRoute = $_SERVER['REQUEST_URI'];
    if ($currentRoute !== '/login' && !isset($_SESSION['user_id'])) {
        header('location: /login');
        exit();
    }
};

$router = new Router() ;

    $router->get('/login', [LoginController::class, 'index'])
            ->post('/login', [LoginController::class, 'login'])
            ->get('/logout', [LoginController::class, 'logout'])
            ->middleware($authMuddleware)
            ->get('/', [OrderController::class, 'index'])
            ->post('/order/create', [OrderController::class, 'createOrder'])
            ->get('/admin/dashboard', [AdminController::class, 'index'])
            ->get('/admin/users', [AdminController::class, 'viewUsers'])
            ->post('/admin/users', [AdminController::class, 'manageUsers'])
            ->get('/admin/orders', [AdminController::class, 'viewOrders']);


(new App(
    $router,
    ['uri'=> $_SERVER['REQUEST_URI'],'method'=> $_SERVER['REQUEST_METHOD']],
    new Config($_ENV),
))
->run();

var_dump($_SESSION);
