<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\View ;

class AdminController
{
    public function index(): View
    {
        return View::make('admin/dashboard');
    }

    public function manageOrders(): View
    {
        return View::make('admin/orders');
    }

    public function manageUsers(): View
    {
        return View::make('admin/users');
    }
}