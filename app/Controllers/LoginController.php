<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\View ;
use App\Models\UserModel ;

class LoginController
{	
	public function __construct(private UserModel $userModel)
	{
	}

	public function index(): View
	{
		return View::make('login');
	}

	public function login(): string
	{	
		$email = $_POST['email'];
		$password = $_POST['password'];

		

	}

	public function signup(): string
	{	
		var_dump($_POST);
		return 'Login Success';
	}
}