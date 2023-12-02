
<?php
require_once(__DIR__.'/../../meta_data.php');

$unOrganizedorders = $data ;

$orders = [];

foreach ($unOrganizedorders as $order) {
    $orderId = $order['order_id'];

    if (!isset($orders[$orderId])) {
        $orders[$orderId] = [
            'order_id' => $orderId,
            'created_by' => $order['created_by'],
            'created_at' => $order['created_at'],
            'amount' => $order['amount'],
            'payment_status' => $order['payment_status'],
            'order_status' => $order['order_status'],
            'items' => [],
        ];
    }

    $orders[$orderId]['items'][] = [
        'menu_id' => $order['menu_id'],
        'name' => $order['menu_name'],
        'price' => $order['menu_price'],
        'quantity' => $order['menu_qty']
    ];
}
$orders = array_reverse($orders);

// var_dump($orders);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once('head.php') ?>
</head>
<body>
<?php require_once('header.php') ?>

<div class="main">

        <div class="report-container">
            <div class="report-header">
                <h1 class="recent-Articles">All orders</h1>
        
            </div>

            <div class="table-responsive text-nowrap">
            <table class="table table-striped align-middle mb-0 bg-white">
                <thead class="bg-light text-center">
                    <tr>
                    <th>Order Id</th>
                    <th>Order Menu</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($orders as $order): ?>
                    <tr>
                    <td class="text-center"><?= $order['order_id'] ?></td>
                    <td>
                        <?php
                                $items = $order['items'];
                                $menuNames = array_map(function ($item) {
                                    return $item['name'].' - '.$item['quantity'].' pcs' ;
                                },$items);
                                ?>
                                
                                <?php foreach($menuNames as $menu): ?>
                                    <p><?= $menu ?></p>
                                <?php endforeach ?>
                                             
                    </td>
                    <td class="text-center">
                    <?= $order['amount'] ?>
                    </td>
                    <td class="text-center">
                        <?php
                            $orderStatus = $order['order_status'];

                            // Define CSS classes for each status
                            $statusClasses = [
                                'cancelled' => 'badge-danger',
                                'taken' => 'badge-warning',
                                'prepairing' => 'badge-primary',
                                'packed' => 'badge-success',
                            ];

                            // Check if the status exists in the array, default to 'badge-secondary' if not found
                            $statusClass = isset($statusClasses[$orderStatus]) ? $statusClasses[$orderStatus] : 'badge-secondary';
                        ?>
                        <form method="post" class="order_status_form" data-order-id="<?= $order['order_id'] ?>" >
                                                            
                                                            <div class="form-group">
                                                                <select class="form-control order_status badge rounded-pill d-inline <?= $statusClass ?>" name="order_status" id="order_status_<?= $order['order_id'] ?>">
                                                                    <?php foreach ($orderStatuses as $status): ?>
                                                                        <option value="<?= $status ?>" <?= ($status == $order['order_status']) ? 'selected' : '' ?>>
                                                                            <?= $status ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                        </form>
                    </td>

                    <td class="text-center">
                    <?php
                            $paymentStatus = $order['payment_status'];

                            // Define CSS classes for each status
                            $paymentStatusClasses = [
                                'unpaid' => 'badge-warning',
                                'paid' => 'badge-success',
                            ];

                            // Check if the status exists in the array, default to 'badge-secondary' if not found
                            $paymentStatusClass = isset($paymentStatusClasses[$paymentStatus]) ? $paymentStatusClasses[$paymentStatus] : 'badge-secondary';
                        ?>
                    <form method="post" class="payment_status_form" data-order-id="<?= $order['order_id'] ?>" >
                    <div class="form-group">
                    <select class="form-control payment_status badge rounded-pill d-inline <?= $paymentStatusClass ?>" name="payment_status" id="payment_status_<?= $order['order_id'] ?>">
                                                <?php foreach ($paymentStatuses as $status): ?>
                                                    <option value="<?= $status ?>" <?= ($status == $order['payment_status']) ? 'selected' : '' ?>>
                                                        <?= $status ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </form>
                    </td>
                    <td class="text-center"><?= $order['created_by'] ?></td>
                    <td class="text-center">
                    <?= $order['created_at'] ?>
                    </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
                </table>
                </div>

 </div>
    </div>
</div>

</body>
</html>