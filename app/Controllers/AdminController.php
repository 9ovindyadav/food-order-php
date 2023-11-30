<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\View ;
use App\Models\UserModel ;

class AdminController
{
    public function index(): View
    {
        return View::make('admin/dashboard');
    }

    public function viewOrders(): View
    {
        return View::make('admin/orders');
    }

    public function viewUsers(): View
    {   
        $userModel = new UserModel();

        $allUsers = $userModel->getAll();

        return View::make('admin/users',$allUsers);
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