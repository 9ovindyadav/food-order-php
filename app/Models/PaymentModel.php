<?php

declare(strict_types=1);

namespace App\Models ;

use App\Model ;

class PaymentModel extends Model
{

    public function create(int $orderId, float $amount): int
    {   
        $status = 'unpaid';

        $statement = $this->db->prepare('INSERT INTO payments( order_id, amount,status) VALUES( ?,?,?)');

        $statement->execute([ $orderId, $amount, $status]);

        return (int) $this->db->lastInsertId() ;
    }
}