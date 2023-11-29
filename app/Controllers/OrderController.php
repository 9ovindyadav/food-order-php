<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\App ;
use App\View ;
use App\Models\OrderModel ;
use App\Models\MenuModel ;

class OrderController
{
	public function index(): View
	{
		$menuModel = new MenuModel();
		$menu = $menuModel->getAll();
		
		return View::make('order',$menu);
	}

	public function createOrder(): string
	{	
		$db = App::db();
		$orderedMenuItems = $_POST['menu'];
		$tableId = (int) $_POST['menu'];

		$orderMenuIds = [] ;
		foreach($orderedMenuItems as $item)
		{
			$id = explode('/', $item)[2];
			$orderMenuIds[] = (int) $id ; 
		}
		$userId = 1 ;
		
		try {
			$orderModel = new OrderModel();
			
			$db->beginTransaction();

			$orderId = $orderModel->create($tableId, $userId);

			foreach($orderMenuIds as $menuId)
			{
				$orderModel->createOrderItems($orderId, $menuId);
			}

			$order = $orderModel->find($orderId);
			
			$db->commit();
			echo '<pre>';
			var_dump($order);
			echo '</pre>';
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