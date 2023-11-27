<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\View ;

class OrderController
{
	public function index(): View
	{
		return View::make('order');
	}

	public function createOrder(): string
	{	
		print_r($_POST) ;
		return 'Order success';
	}
}