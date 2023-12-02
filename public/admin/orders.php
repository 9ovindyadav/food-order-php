
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
            <div class="table-responsive text-nowrap">
            <table class="table table-striped align-middle mb-0 bg-white">
                <thead class="bg-light text-center">
                    <tr>
                    <th>Order Id</th>
                    <th>Order Menu</th>
                    <th>Amount</th>
                    <th>Status</th>
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
                                <ol>
                                <?php foreach($menuNames as $menu): ?>
                                    <li><?= $menu ?></li>
                                <?php endforeach ?>
                                </ol>                 
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
    <span class="badge rounded-pill d-inline <?= $statusClass ?>"><?= $orderStatus ?></span>
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
</div>

</body>
</html>