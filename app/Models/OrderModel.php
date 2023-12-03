<?php

declare(strict_types=1);

namespace APP\Models ;

use App\Model ;

class OrderModel extends Model
{
    public function create(int $userId): int
    {   
       $status = 'taken';
        $statement = $this->db->prepare('INSERT INTO orders( user_id, status, created_at) VALUES( ?,?, NOW() )');

        $statement->execute([ $userId, $status]);

        return (int) $this->db->lastInsertId() ;
    }

    public function createOrderItems(int $orderId, int $menuId, int $qty = 1 ): int
    {
        $statement = $this->db->prepare('INSERT INTO order_items(order_id, menu_id, quantity) VALUES( ?, ?, ? )');

        $statement->execute([$orderId, $menuId, $qty]);

        return (int) $this->db->lastInsertId() ;
    }

    public function updateStatus(int $orderId, string $orderStatus): bool
    {
       $statement = $this->db->prepare('UPDATE orders SET status = ? WHERE id = ? ');

       $statement->execute([$orderStatus ,$orderId ]);

       return true ;
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
                                    'SELECT     order_items.order_id AS order_id,
                                    menus.id AS menu_id,
                                    menus.name AS menu_name,
                                    menus.price AS menu_price,
                                    order_items.quantity AS menu_qty,
                                    orders.status AS order_status ,
                                    payments.amount AS amount,
                                    payments.status payment_status,
                                    users.name AS created_by,
                                    orders.created_at As created_at
                         FROM       orders
                         LEFT JOIN order_items
                         ON         orders.id = order_items.order_id
                         LEFT JOIN  users
                         ON         orders.user_id = users.id
                         LEFT JOIN  menus
                         ON         order_items.menu_id = menus.id
                         LEFT JOIN  payments
                         ON         orders.id = payments.order_id 
                                    ');
                        
        $statement->execute();
        $orders = $statement->fetchAll();

        return $orders ?? [] ; 
    }

    public function getAllUnPaidOrders(): array
    {
        $statement = $this->db->prepare(
                                    'SELECT     order_items.order_id AS order_id,
                                    menus.id AS menu_id,
                                    menus.name AS menu_name,
                                    menus.price AS menu_price,
                                    order_items.quantity AS menu_qty,
                                    orders.status AS order_status ,
                                    payments.amount AS amount,
                                    payments.status payment_status,
                                    users.name AS created_by,
                                    orders.created_at As created_at
                         FROM       orders
                         LEFT JOIN order_items
                         ON         orders.id = order_items.order_id
                         LEFT JOIN  users
                         ON         orders.user_id = users.id
                         LEFT JOIN  menus
                         ON         order_items.menu_id = menus.id
                         LEFT JOIN  payments
                         ON         orders.id = payments.order_id 
                         WHERE payments.status = "unpaid" AND NOT orders.status = "cancelled"
                                    ');
                        
        $statement->execute();
        $orders = $statement->fetchAll();

        return $orders ?? [] ; 
    }

    public function kitchenPendingOrders(): array
    {
        $statement = $this->db->prepare(
                                    'SELECT     order_items.order_id AS order_id,
                                    menus.id AS menu_id,
                                    menus.name AS menu_name,
                                    menus.price AS menu_price,
                                    order_items.quantity AS menu_qty,
                                    orders.status AS order_status ,
                                    payments.amount AS amount,
                                    payments.status payment_status,
                                    users.name AS created_by,
                                    orders.created_at As created_at
                         FROM       orders
                         LEFT JOIN order_items
                         ON         orders.id = order_items.order_id
                         LEFT JOIN  users
                         ON         orders.user_id = users.id
                         LEFT JOIN  menus
                         ON         order_items.menu_id = menus.id
                         LEFT JOIN  payments
                         ON         orders.id = payments.order_id 
                         WHERE
                         orders.status NOT IN ("packed","cancelled")
                                    ');
                        
        $statement->execute();
        $orders = $statement->fetchAll();

        return $orders ?? [] ; 
    }


    public function adminDashboardData(): array
    {
        $statement = $this->db->prepare('SELECT
        (SELECT COUNT(*) FROM orders) AS total_orders,
        (SELECT COUNT(*) FROM users) AS total_users,
        (SELECT COUNT(*) FROM menus) AS total_menu_items,
        (SELECT SUM(amount) FROM payments WHERE status = "paid") AS total_revenue,
        (SELECT COUNT(*) FROM orders WHERE status = "cancelled") AS cancelled_orders,
        (SELECT COUNT(*) FROM orders WHERE status IN ("taken", "preparing")) AS pending_orders;
    ');
                        
        $statement->execute();
        $orders = $statement->fetchAll();

        return $orders ?? [] ; 
    }
}