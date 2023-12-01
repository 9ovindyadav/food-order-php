<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\View ;
use App\Models\MenuModel ;
use App\Models\OrderModel ;

class KitchenController
{
    public function index(): View
	{
		return View::make('kitchen/pending_orders');
	}

    public function viewAllOrders(): View
	{
        $orderModel = new OrderModel();
        $orders = $orderModel->getAll();

		return View::make('kitchen/all_orders', $orders);
	}

    public function viewProfile(): View
	{
		return View::make('kitchen/profile');
	}

    public function viewAllMenus(): View
	{
		return View::make('kitchen/menus');
	}
    
}