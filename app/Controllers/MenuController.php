<?php

declare(strict_types=1);

namespace App\Controllers ;
use App\Models\MenuModel;

class MenuController
{
	public function createMenu(): string
	{	
        $name = $_POST['menu_name'];
        $price = (int) $_POST['price'];
        $img = $_POST['img'];
        $menuModel = new MenuModel();

        $menuId = $menuModel->create($name, $price, $img);
        
        if($menuId){
            return 'Menu added with menu id '.$menuId ;
        }else{
            return 'Provide all the credentials.';
        }            
	}

    public function updateMenu(): string
	{	
        $menuId = (int) $_POST['menu_id'];
        $name = $_POST['menu_name'];
        $price = (int) $_POST['price'];
        $img = $_POST['img'];
        $menuStatus = (int) $_POST['menu_status'];

        $menuModel = new MenuModel();

        $isUpdated = $menuModel->update($menuId,$name, $price, $img, $menuStatus);
        
        if($isUpdated){
            return "Menu $menuId updated" ;
        }           
	}

    public function updateMenuStatus(): string
	{	
		$menuId = (int) $_POST['menu_id'];
        $menuStatus = (int) $_POST['menu_status'];
        
        $menuModel = new MenuModel();

        $isUpdated = $menuModel->updateStatus($menuId, $menuStatus);
        
        if($isUpdated){
            return "Menu $menuId status updated" ;
        }
	}

    public function deleteMenu(): string
    {
        $menuId = (int) $_POST['menu_id'];
        
        $menuModel = new MenuModel();

        $isDeleted = $menuModel->delete($menuId);
        
        if($isDeleted){
            return "Menu $menuId Deleted" ;
        }
    }
}