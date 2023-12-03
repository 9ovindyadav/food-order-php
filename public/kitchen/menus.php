<?php 
$menus = $data;

require_once(__DIR__.'/../../meta_data.php');
 
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
			<h1 class="recent-Articles">Menus</h1>	
				
		</div>

		<div class="table-responsive text-nowrap">
			<table class="table table-striped align-middle">
				<thead>
					<tr>
					<th scope="col">ID</th>
					<th scope="col">Name</th>
					<th scope="col">Price</th>
					<th scope="col">Image</th>
					<th scope="col">Status</th>
                    <th scope="col">Created At</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach ($menus as $menu): ?>
						<tr>
							<th scope="row"><?= $menu['id'] ?></th>
							<td><?= $menu['name'] ?></td>
							<td><?= $menu['price'] ?></td>
					
                            <td>
                                <div class="d-flex align-items-center">
                                <img
                                    src="<?= $menu['img'] ?>"
                                    alt=""
                                    style="width: 45px; height: 45px"
                                    class="rounded-circle"
                                    />
                                
                                </div>
                            </td>
                            <td>
                                <?php
                                    $menuStatus = $menu['is_active'];

                                    $statusClasses = [
                                        0 => 'badge-danger',
                                        1 => 'badge-success',
                                    ];
                                    $statusLabels = [
                                        0 => 'Not Available',
                                        1 => 'Available'
                                    ];

                                    $statusClass = isset($statusClasses[$menuStatus]) ? $statusClasses[$menuStatus] : 'badge-secondary';

                                    $statusLabel = isset($statusLabels[$menuStatus]) ? $statusLabels[$menuStatus] : 'Unknown';
                                    
                                ?>

                                    <form method="post" class="menu_status_form" data-menu-id="<?= $menu['id'] ?>" >
                                    <div class="form-group">
                                    <select class="menu_status badge rounded-pill d-inline <?= $statusClass ?>" name="menu_status" id="menu_status_<?= $order['menu_id'] ?>">
                                                <?php foreach ([1,0] as $status): ?>
                                                    <option value="<?= $status ?>" <?= ($status == $menu['is_active']) ? 'selected' : '' ?>>
                                                        <?= $statusLabels[$status] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </form>
                            </td>
                            <td><?= $menu['created_at'] ?></td>
							
						</tr>
					<?php endforeach; ?>	
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>


</body>
</html>
