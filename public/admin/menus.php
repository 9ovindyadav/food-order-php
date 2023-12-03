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
			
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-new-menu">
							Add Menu
			 </button>

			
				
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
					<th scope="col">Update</th>
					<th scope="col">Delete</th>
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
							<td>
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update-menu-modal-<?= $menu['id'] ?>">
									   Update
								   </button>

								   <!-- Modal -->
								   <div class="modal fade update-user-modal"
								id="update-menu-modal-<?= $menu['id'] ?>"	
								 tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									   <div class="modal-dialog">
										   <div class="modal-content">
											   <div class="modal-header">
												   <h5 class="modal-title" id="exampleModalLabel">Update Menu</h5>
												   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
													   <span aria-hidden="true">&times;</span>
												   </button>
											   </div>
											   <div class="modal-body">
												   <!-- Update form with pre-filled values -->
												   <form method="post" class="admin_update_menu">
													   <input type="hidden" name="menu_id" value="<?= $menu['id'] ?>">
													   <div class="form-group">
														   <label for="menu_name">Menu Name</label>
														   <input type="text" class="form-control" id="menu_name" name="menu_name" value="<?= $menu['name'] ?>" required>
													   </div>
													   <div class="row">
                                                       <div class="col-6 form-group">
														   <label for="menu_price">Price</label>
														   <input type="text" class="form-control" id="menu_price" name="menu_price" value="<?= $menu['price'] ?>" required>
													   </div>
                                                       <div class="col-6 form-group">
														   <label for="menu_status">Status</label>
														   <select 
															   class="form-control" 
															   name="menu_status"
															   id="menu_status">
															  <?php 
															  $roleOptions = array_map(function($role) use ($menu) {
																	 $selected = ($role == $menu['is_active']) ? 'selected' : '';
																	 return "<option value=\"$role\" $selected>$role</option>";
																 }, [0,1]);

															  echo(implode("", $roleOptions));
															  ?>
															</select>
													   </div>
                                                       </div>
													   <div class="form-group">
														   <label for="menu_img">Image link</label>
														   <input type="text" class="form-control" id="menu_img" name="menu_img" value="<?= $menu['img'] ?>" required>
													   </div>

													   <button type="submit" name="update_user" class="btn btn-primary w-100">Update</button>
												   </form>
											   </div>
										   </div>
									   </div>
								   </div>
							</td>
							<td>
							<form method="post" class="admin_delete_menu" style="display: inline;">
												  <input type="hidden" name="menu_id" value="<?= $menu['id'] ?>">
												  <button type="submit" name="delete_menu" class="btn btn-danger">Delete</button>
											  </form>
							</td>
							
						</tr>
					<?php endforeach; ?>	
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>

 <!-- Add new user modal -->
 <div class="modal fade" id="add-new-menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Add Menu</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="POST" id="admin_add_menu">
							<div class="row">
								<div class="col-12 form-group">
									<label for="full-name">Name</label>
									<input 
										type="text" 
										class="form-control" 
										id="menu_name"
										name="menu_name" 
										placeholder="Enter menu name">
								</div>
								<div class="col-12 form-group">
									<label for="email">Price</label>
									<input 
										type="text" 
										class="form-control" 
										name="price" 
										id="price" 
										placeholder="Price">
								</div>
                                <div class="col-12 form-group">
									<label for="email">Image link</label>
									<input 
										type="text" 
										class="form-control" 
										name="img" 
										id="img" 
										placeholder="Image link">
								</div>
								
							</div>
							
							<div class="row my-3">
								<div class="col">
									<button type="submit" name="add_menu" class="btn btn-primary w-100">Add Menu</button>
								</div>
							</div>
						</form>
					</div>

					</div>
				</div>

</div>

</body>
</html>
