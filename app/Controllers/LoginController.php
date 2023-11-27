<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\View ;

class LoginController
{
	public function index(): View
	{
		return View::make('login');
	}

	public function login(): string
	{	
		return 'Login success';
	}

	public function signup(): string
	{	
		var_dump($_POST);
		return 'Login Success';
	}
}