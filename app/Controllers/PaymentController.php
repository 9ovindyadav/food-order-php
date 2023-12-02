<?php

declare(strict_types=1);

namespace App\Controllers ;

use App\Models\PaymentModel ;

class PaymentController
{
    public function updatePaymentStatus(): string
    {
        $orderId = (int) $_POST['order_id'];
        $paymentStatus = (string) $_POST['payment_status'];

        $paymentModel = new PaymentModel();
        $isUpdated = $paymentModel->statusUpdate($orderId, $paymentStatus);

        if($isUpdated){
            return "Order id $orderId , Set to $paymentStatus";
        }
    }
}