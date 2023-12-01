<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\App ;
use App\View ;
use App\Models\OrderModel ;
use App\Models\MenuModel ;

class OrderController
{
	public function getAllOrders(): array
	{
		$orderModal = new OrderModal();
		$orders = $orderModal->getAllOrders();
		return $orders ?? [] ;
	}

	public function createOrder(): string
	{	
		$db = App::db();
		$orderedMenuItems = $_POST['menu'];
		$userId = (int) $_POST['user_id'];
		
		$orderMenuIds = [] ;
		foreach($orderedMenuItems as $item)
		{
			$orderMenuIds[] = (int) $item['id'] ; 
		}
		
		try {
			$orderModel = new OrderModel();
			
			$db->beginTransaction();

			$orderId = $orderModel->create($userId);

			foreach($orderMenuIds as $menuId)
			{
				$orderModel->createOrderItems($orderId, $menuId);
			}

			$order = $orderModel->find($orderId);
			
			$db->commit();
		
			var_dump($order[0]['order_id']);
			return 'Order created';

		} catch (\Throwable $error) {
			if($db->inTransaction())
			{
				$db->rollback();
			}

			throw $error ;
		}
		
	}
}