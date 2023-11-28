<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\App ;
use App\View ;

class OrderController
{
	public function index(): View
	{	
		$conn = App::db();

		return View::make('order');
	}

	public function createOrder(): string
	{	
		print_r($_POST) ;
		return 'Order success';
	}
}