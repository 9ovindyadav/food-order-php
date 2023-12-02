<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\View ;
use App\Models\UserModel ;
use App\Models\OrderModel ;

class KitchenController
{
    public function index(): View
	{
		$orderModel = new OrderModel();
        $orders = $orderModel->kitchenPendingOrders();
	
		return View::make('kitchen/pending_orders',$orders);
	}

    public function viewAllOrders(): View
	{
        $orderModel = new OrderModel();
        $orders = $orderModel->getAll();

		return View::make('kitchen/all_orders', $orders);
	}

    public function viewProfile(): View
	{
		$userId = (int) $_GET['user_id'];
		
		$userModel = new UserModel();
		$user = $userModel->findById($userId);

		return View::make('kitchen/profile', $user);
	}

    public function viewAllMenus(): View
	{
		return View::make('kitchen/menus');
	}
    
}