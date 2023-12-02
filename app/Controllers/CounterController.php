<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\Models\UserModel;
use App\View ;
use App\Models\MenuModel ;
use App\Models\OrderModel ;


class CounterController
{
    public function index(): View
	{
		return View::make('counter/home');
	}

    public function viewNewOrderForm(): View
	{
		$menuModel = new MenuModel();
		$activeMenu = $menuModel->getAll();
	
		return View::make('counter/new_order',$activeMenu);
	}

    public function viewAllOrders(): View
	{
        $orderModel = new OrderModel();
        $orders = $orderModel->getAll();

		return View::make('counter/all_orders', $orders);
	}

    public function viewProfile(): View
	{
		$userId = (int) $_GET['user_id'];
		
		$userModel = new UserModel();
		$user = $userModel->findById($userId);
		
		return View::make('counter/profile', $user);
	}

    public function viewPendingPaymentOrders(): View
    {	
		$orderModel = new OrderModel();
		$unpaidOrders = $orderModel->getAllUnPaidOrders();

        return View::make('counter/pending_payments', $unpaidOrders);
    }
    
}