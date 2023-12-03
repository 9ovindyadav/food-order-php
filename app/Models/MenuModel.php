<?php

declare(strict_types=1);

namespace App\Models ;

use App\Model ;

class MenuModel extends Model
{
    public function getAll(): array
    {
        $statement = $this->db->prepare('SELECT id, name, price, img, is_active, created_at FROM menus');

        $statement->execute();
        $menu = $statement->fetchAll();

        return $menu ?? [] ;
    }

    public function create(string $name, int $price, string $img, int $isActive = 0 ): int
    {
        if($name && $price && $img){

            $statement = $this->db->prepare('INSERT INTO menus ( name, price, img, is_active, created_at) VALUES( :name, :price, :img, :isActive ,NOW() )');

            $statement->execute([':name' => $name,
                                ':price' => $price, 
                                ':img' => $img , 
                                ':isActive' => $isActive, 
                            ]);

            return (int) $this->db->lastInsertId() ;
        }

        return 0 ;
    }

    public function updateStatus(int $menuId, int $menuStatus = 0 ): bool
    {
       $statement = $this->db->prepare('UPDATE menus SET is_active = ? WHERE id = ? ');

       $statement->execute([$menuStatus ,$menuId ]);

       return true ;
    }

    public function delete(int $menuId): bool
    {
        $statement = $this->db->prepare('DELETE FROM menus WHERE id = ?');

        $statement->execute([$menuId]);
        
        return true ;
    }
}