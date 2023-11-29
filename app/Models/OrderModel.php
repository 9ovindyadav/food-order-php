<?php

declare(strict_types=1);

namespace APP\Models ;

use App\Model ;

class OrderModel extends Model
{
    public function create(int $tableId, int $userId): int
    {
        $statement = $this->db->prepare('INSERT INTO orders(table_id, user_id, created_at) VALUES( ?, ?, NOW() )');

        $statement->execute([$tableId, $userId]);

        return (int) $this->db->lastInsertId() ;
    }

    public function createOrderItems(int $orderId, int $menuId, int $qty = 1 ): int
    {
        $statement = $this->db->prepare('INSERT INTO order_items(order_id, menu_id, quantity) VALUES( ?, ?, ? )');

        $statement->execute([$orderId, $menuId, $qty]);

        return (int) $this->db->lastInsertId() ;
    }

    public function find(int $orderId): array
    {
        $statement = $this->db->prepare(
                                    'SELECT
                                        orders.id AS order_id,
                                        tables.id AS table_id,
                                        users.name AS user_name,
                                        orders.created_at AS order_created_at,
                                        menus.id AS menu_id,
                                        menus.name AS menu_name,
                                        order_items.quantity
                                    FROM orders
                                    LEFT JOIN users ON users.id = orders.user_id 
                                    LEFT JOIN tables ON tables.id = orders.table_id
                                    LEFT JOIN order_items ON order_items.order_id = orders.id
                                    LEFT JOIN menus ON menus.id = order_items.menu_id
                                    WHERE orders.id = ?;
                                    ');
                        
        $statement->execute([$orderId]);
        $order = $statement->fetch();

        return $order ?? [] ; 
    }
}