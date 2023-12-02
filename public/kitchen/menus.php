
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
                <h1 class="recent-Articles">All Menu</h1>
        
            </div>

            <div class="report-body">
                <div class="report-topic-heading all-orders-table-heading">
                    <h3 class="t-op">Menu Id</h3>
                    <h3 class="t-op">Name</h3>
                    <h3 class="t-op">Image</h3>
                    <h3 class="t-op">Price</h3>
                    <h3 class="t-op">Status</h3>
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
                                <h3 class="t-op-nextlvl">
                                    <form method="post" class="order_status_form" data-order-id="<?= $order['order_id'] ?>" >
                                        
                                        <div class="form-group">
                                            <select class="form-control order_status" name="order_status" id="order_status_<?= $order['order_id'] ?>">
                                                <?php foreach ($orderStatus as $status): ?>
                                                    <option value="<?= $status ?>" <?= ($status == $order['order_status']) ? 'selected' : '' ?>>
                                                        <?= $status ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </form>
                                </h3>
                                <h3 class="t-op-nextlvl"><?= $order['payment_status'] ?></h3>
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