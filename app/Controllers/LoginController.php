<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\View ;
use App\Models\UserModel ;

class LoginController
{	
	private UserModel $userModel;

	public function index(): View
	{
		return View::make('login');
	}

	public function login(): string
	{	
		$email = $_POST['email'];
		$password = $_POST['password'];

		$userModel = new UserModel();
		if($email && $password){
			
			try {
				$isAuthenticated = $userModel->authenticate($email, $password);
				if($isAuthenticated){
					return 'Logged In';
				}	
			} catch (\Exception $error) {
				return $error->getMessage();
			}
		}else{
			return 'Please provide all the credentials.';
		}
		

	}

	public function logout(): string
	{	
		$_SESSION = array();
		session_destroy();
		header('location: /login');
		return 'Logged out';
	}
}