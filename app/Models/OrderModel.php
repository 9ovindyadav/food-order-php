<?php

declare(strict_types=1);

namespace APP\Models ;

use App\Model ;

class OrderModel extends Model
{
    public function create(int $userId): int
    {
        $statement = $this->db->prepare('INSERT INTO orders( user_id, created_at) VALUES( ?, NOW() )');

        $statement->execute([ $userId]);

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
                                    'SELECT oi.order_id,
                                    oi.menu_id,
                                    m.NAME,
                                    m.price,
                                    oi.quantity,
                                    u.NAME AS user_name,
                                    o.created_at
                             FROM   order_items AS oi
                                    INNER JOIN orders AS o
                                            ON oi.order_id = o.id
                                    LEFT JOIN users AS u
                                           ON o.user_id = u.id
                                    LEFT JOIN menus AS m
                                           ON oi.menu_id = m.id
                             WHERE  o.id = ?;  
                                    ');
                        
        $statement->execute([$orderId]);
        $order = $statement->fetchAll();

        return $order ?? [] ; 
    }


    public function getAll(): array
    {
        $statement = $this->db->prepare(
                                    'SELECT oi.order_id,
                                    oi.menu_id,
                                    m.NAME,
                                    m.price,
                                    oi.quantity,
                                    u.NAME AS user_name,
                                    o.created_at
                             FROM   order_items AS oi
                                    INNER JOIN orders AS o
                                            ON oi.order_id = o.id
                                    LEFT JOIN users AS u
                                           ON o.user_id = u.id
                                    LEFT JOIN menus AS m
                                           ON oi.menu_id = m.id 
                                    ');
                        
        $statement->execute();
        $orders = $statement->fetchAll();

        return $orders ?? [] ; 
    }
}