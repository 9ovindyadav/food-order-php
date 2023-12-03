<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\View ;
use App\Models\UserModel ;

class LoginController
{	
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
					if($_SESSION['user_role'] === 'admin'){
						header('location: /admin/dashboard');
					}
					if($_SESSION['user_role'] === 'counter_staff'){
						header('location: /counter/home');
					}
					if($_SESSION['user_role'] === 'kitchen_staff'){
						header('location: /kitchen/pending_orders');
					}
					return 'Logged In';
				}	
			} catch (\Exception $error) {
				return $error->getMessage();
			}
		}else{
			return 'Please provide all the credentials.';
		}
		

	}

	public function updatePassword(): string
	{
		$userId = (int) $_POST['user_id'];
		$newPassword = $_POST['new_password'];
		$rePassword = $_POST['re_password'];
		
		$userModel = new UserModel();

		if($userId && $newPassword && $rePassword){
			if($newPassword !== $rePassword){
				return 'Password not matched';
			}
			$isUpdated = $userModel->updatePassword($userId, $newPassword);

			if($isUpdated){
				return "User $userId password updated";
			}

		}else{
			return 'Please provide all credentials';
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