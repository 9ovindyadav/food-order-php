<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\View ;
use App\Models\UserModel ;
use App\Models\OrderModel ;
use App\Models\MenuModel ;

class AdminController
{
    public function index(): View
    {
        $orderModel = new OrderModel();

        $orders = $orderModel->kitchenPendingOrders();
        $dashboardData = $orderModel->adminDashboardData();
        $data = ['dashboard' => $dashboardData,'orders'=> $orders];
        return View::make('admin/dashboard', $data);
    }

    public function viewOrders(): View
    {   
        $orderModel = new OrderModel();
        $orders = $orderModel->getAll();

        return View::make('admin/orders', $orders);
    }

    public function viewUsers(): View
    {   
        $userModel = new UserModel();

        $allUsers = $userModel->getAll();

        return View::make('admin/users',$allUsers);
    }

    public function viewMenus(): View
    {   
        $menuModel = new MenuModel();
        $menus = $menuModel->getAll();

        return View::make('admin/menus', $menus);
    }

    public function viewProfile(): View
    {   
        $userId = (int) $_GET['user_id'];
		
		$userModel = new UserModel();
		$user = $userModel->findById($userId);
        return View::make('admin/profile', $user);
    }

    public function manageUsers(): string
    {
        $userModel = new UserModel();

        try{
            if(isset($_POST['add_user'])){
                $name = $_POST['full_name'];
                $email = $_POST['email'];
                $role = $_POST['role'];
    
                $userId = $userModel->create($name, $email, $role);
                
                if($userId){
                    return 'User added with user id '.$userId ;
                }else{
                    return 'Provide all the credentials.';
                }
                
            }
    
            if(isset($_POST['update_user'])){
                $userId = (int) $_POST['user_id'];
                $name = $_POST['full_name'];
                $email = $_POST['email'];
                $role = $_POST['role'];
    
                $isUpdated = $userModel->update($userId,$name, $email, $role);
                
                if($isUpdated){
                    return 'User updated  /  user id '.$userId ;
                }else{
                    return 'Provide all the credentials';
                }
            }
    
            if(isset($_POST['delete_user'])){
                $userId = (int) $_POST['user_id'];

                if($userModel->delete($userId)){

                    return 'User Deleted with id'.$userId ;
                }else{
                    return 'User not deleted.';
                }
                
            }

        }catch(\PDOException $error){

            return $error->getMessage();

         }

         return 'Error occured';
    }
}