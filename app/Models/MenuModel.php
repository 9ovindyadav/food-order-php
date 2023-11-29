<?php

declare(strict_types=1);

namespace App\Models ;

use App\Model ;

class MenuModel extends Model
{
    public function getAll(): array
    {
        $statement = $this->db->prepare('SELECT id, name, price, img FROM menus');

        $statement->execute();
        $menu = $statement->fetchAll();

        return $menu ?? [] ;
    }
}