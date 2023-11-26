<?php

declare(strict_types=1);

namespace App\Classes ;

class Login
{
	public function index(): string
	{
		return '<form action="/login/auth" method="post"><labe>email <input type="text" name="email"></label></form>';
	}

	public function login(): string
	{	
		var_dump($_POST);
		return 'Login Success';
	}
}