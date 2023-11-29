<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\App ;
use App\View ;
use App\Models\OrderModel ;

class OrderController
{
	public function index(): View
	{
		return View::make('order');
	}

	public function createOrder(): string
	{	
		$db = App::db();

		$userId = 1 ;
		$menuId = 1 ;

		try {
			$orderModel = new OrderModel();

			$orderId = $orderModel->create($menuId, $userId);
			$order = $orderModel->find($orderId);
			
			var_dump($order);

			return 'Order created';

		} catch (\Throwable $error) {
			throw $error ;
		}
		
	}
}