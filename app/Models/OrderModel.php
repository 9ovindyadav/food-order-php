<?php

declare(strict_types=1);

namespace APP\Models ;

use App\Model ;

class OrderModel extends Model
{
    public function create(int $menuId, int $userId): int
    {
        $statement = $this->db->prepare('INSERT INTO orders(menu_id, user_id, created_at) VALUES( ?, ?, NOW() )');

        $statement->execute([$menuId, $userId]);

        return (int) $this->db->lastInsertId() ;
    }

    public function find(int $orderId): array
    {
        $statement = $this->db->prepare(
                                    'SELECT orders.id, menus.name, users.name, orders.created_at 
                                    FROM orders
                                    LEFT JOIN users ON users.id = orders.user_id 
                                    LEFT JOIN menus ON menus.id = orders.menu_id
                                    WHERE orders.id = ? ');
                        
        $statement->execute([$orderId]);
        $order = $statement->fetch();

        return $order ?? [] ; 
    }
}