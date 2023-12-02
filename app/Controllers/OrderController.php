<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\App ;
use App\Models\OrderModel ;
use App\Models\PaymentModel ;

class OrderController
{
	public function getAllOrders(): array
	{
		$orderModal = new OrderModal();
		$orders = $orderModal->getAllOrders();
		return $orders ?? [] ;
	}

	public function updateOrderStatus(): string
	{
		$orderId = (int) $_POST['order_id'];
		$orderStatus = (string) $_POST['order_status'];

		$orderModel = new OrderModel();
		$isUpdated = $orderModel->updateStatus($orderId, $orderStatus);

		if($isUpdated){
			return "Order id $orderId status updated to $orderStatus";
		}else{
			return "Order id $orderId status not updated";
		}
	}

	public function createOrder(): string
	{	
		$db = App::db();
		$orderedMenuItems = $_POST['menu'];
		$userId = (int) $_POST['user_id'];
		$amount = 0 ;
		
		$orderMenuIds = [] ;
		foreach($orderedMenuItems as $item)
		{
			$orderMenuIds[] = (int) $item['id'] ; 
			$amount += (int) $item['price'];
		}
		
		try {
			$orderModel = new OrderModel();
			$paymentModel = new PaymentModel();
			
			$db->beginTransaction();

			$orderId = $orderModel->create($userId);

			foreach($orderMenuIds as $menuId)
			{
				$orderModel->createOrderItems($orderId, $menuId);
			}
			$paymentModel->create($orderId, $amount);
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