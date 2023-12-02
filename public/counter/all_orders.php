
<?php
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

            <div class="report-body">
                <div class="report-topic-heading all-orders-table-heading">
                    <h3 class="t-op">Order Id</h3>
                    <h3 class="t-op">Order Items</h3>
                    <h3 class="t-op">Amount</h3>
                    <h3 class="t-op">Status</h3>
                    <h3 class="t-op">Payment</h3>
                    <h3 class="t-op">Created By</h3>
                    <h3 class="t-op">Created At</h3>
                </div>
                <div class="items">
                    <?php foreach($orders as $order): ?>
                    <div class="item1 all-orders-table">
                                <h3 class="t-op-nextlvl"><?= $order['order_id'] ?></h3>
                                <h3 class="t-op-nextlvl order-menu">
                                    <?php
                                    $items = $order['items'];
                                    $menuNames = array_map(function ($item) {
                                        return $item['name'].' - '.$item['quantity'].' pcs' ;
                                    },$items);
                                    ?>
                                    <ol>
                                    <?php foreach($menuNames as $menu): ?>
                                        <li><?= $menu ?></li>
                                    <?php endforeach ?>
                                    </ol>
                                </h3>
                                <h3 class="t-op-nextlvl"><?= $order['amount'] ?></h3>
                                <h3 class="t-op-nextlvl"><?= $order['order_status'] ?></h3>
                                <h3 class="t-op-nextlvl"><?= $order['payment_status'] ?></h3>
                                <h3 class="t-op-nextlvl"><?= $order['created_by'] ?></h3>
                                <h3 class="t-op-nextlvl"><?= $order['created_at'] ?></h3>
                    </div>
                    <?php endforeach ?>
                </div>
                
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>