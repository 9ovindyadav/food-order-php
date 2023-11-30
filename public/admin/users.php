<?php 
$users = $data;

$roles = ['admin', 'user'];
$countries = ['india','nepal'] 
?>


        <?php require_once('sidebar.php') ?>

        
		<div class="main">
			<div class="report-container">
				<div class="report-header">
					<h1 class="recent-Articles">All Users</h1>
                    
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-new-user">
                                    Add user
	 			    </button>

                    
                        
                </div>

				<div class="report-body">
					<div class="report-topic-heading">
						<h3 class="t-op">User Id</h3>
						<h3 class="t-op">Name</h3>
						<h3 class="t-op">Email</h3>
                        <h3 class="t-op">Role</h3>
						<h3 class="t-op">Last Updated</h3>
                        <h3 class="t-op"></h3>
					</div>

					<div class="items">
                                            
            
                       
                        <?php foreach ($users as $user): ?>
	 					  	    <div class="item1">
                                    <h3 class="t-op-nextlvl"><?= $user['id'] ?></h3>
                                    <h3 class="t-op-nextlvl"><?= $user['name'] ?></h3>
                                    <h3 class="t-op-nextlvl"><?= $user['email'] ?></h3>
                                    <h3 class="t-op-nextlvl"><?= $user['role'] ?></h3>
                                    <h3 class="t-op-nextlvl"><?= $user['updated_at'] ?></h3>
	 					  	
                                    <h3 class="t-op-nextlvl">
	 					  	            <!-- Button to trigger the modal -->
	 					  	            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update-user-modal-<?= $user['id'] ?>">
	 					  	                Update
	 					  	            </button>

	 					  	            <form method="post" class="admin_delete_user" style="display: inline;">
	 					  	                           <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
	 					  	                           <button type="submit" name="delete_user" class="btn btn-danger">Delete</button>
	 					  	                       </form>

	 					  	            <!-- Modal -->
	 					  	            <div class="modal fade" id="update-user-modal-<?= $user['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	 					  	                <div class="modal-dialog">
	 					  	                    <div class="modal-content">
	 					  	                        <div class="modal-header">
	 					  	                            <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
	 					  	                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	 					  	                                <span aria-hidden="true">&times;</span>
	 					  	                            </button>
	 					  	                        </div>
	 					  	                        <div class="modal-body">
	 					  	                            <!-- Update form with pre-filled values -->
	 					  	                            <form method="post" id="admin_update_user">
	 					  	                                <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
	 					  	                                <div class="form-group">
	 					  	                                    <label for="full_name">Full Name</label>
	 					  	                                    <input type="text" class="form-control" id="full_name" name="full_name" value="<?= $user['name'] ?>" required>
	 					  	                                </div>
	 					  	                                <div class="form-group">
	 					  	                                    <label for="email">Email</label>
	 					  	                                    <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
	 					  	                                </div>
	 					  	                                <div class="form-group">
	 					  	                                    <label for="role">Role</label>
	 					  	                                    <select 
	 					  	                                    	class="form-control" 
	 					  	                                    	name="role"
	 					  	                                    	id="role">
	 					  	                                       <?php 
	 					  	                                       $roleOptions = array_map(function($role) use ($user) {
	 					  	                                              $selected = ($role == $user['role']) ? 'selected' : '';
	 					  	                                              return "<option value=\"$role\" $selected>$role</option>";
	 					  	                                          }, $roles);

	 					  	                                       echo(implode("", $roleOptions));
	 					  	                                       ?>
	 					  	                                     </select>
	 					  	                                </div>

	 					  	                                <button type="submit" name="update_user" class="btn btn-primary w-100">Update</button>
	 					  	                            </form>
	 					  	                        </div>
	 					  	                    </div>
	 					  	                </div>
	 					  	            </div>
                                    </h3>
                                </div>
	 					  	<?php endforeach; ?>

					</div>
				</div>
			</div>
		</div>
     
         <!-- Add new user modal -->
         <div class="modal fade" id="add-new-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add new user</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" id="admin_add_user">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="full-name">Full name</label>
                                            <input 
                                                type="text" 
                                                class="form-control" 
                                                id="full-name"
                                                name="full_name" 
                                                placeholder="Enter your full name">
                                        </div>
                                        <div class="col-12 form-group">
                                            <label for="email">Email address</label>
                                            <input 
                                                type="email" 
                                                class="form-control" 
                                                name="email" 
                                                id="email" 
                                                placeholder="name@example.com">
                                        </div>
                                        <div class="col-12 form-group">
                                        <label for="role">Role</label>
	 					  	                <select 
	 					  	                    class="form-control" 
	 					  	                   	name="role"
	 			                            	id="role">
                                                <option value="">Choose role</option>		  	                         
                                                <?php foreach($roles as $role): ?>
                                                    <option value="<?= $role ?>"><?= $role ?></option>
                                                <?php endforeach ?>    
	 					  	                 </select>
	                                    </div>
                                    </div>
                                    
                                    <div class="row my-3">
                                        <div class="col">
                                            <button type="submit" name="add_user" class="btn btn-primary w-100">Add user</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            </div>
                        </div>
        
	</div>

