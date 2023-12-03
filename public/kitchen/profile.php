<?php
$userData = $data ;
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
    <section>
  <div class="container py-5">

    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
              class="rounded-circle img-fluid" style="width: 150px;">
            <h5 class="my-3"><?= $userData['name'] ?></h5>
            <p class="text-muted text-center mb-1"><?= $userData['role'] ?></p>
            
          </div>
        </div>
        
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $userData['name'] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $userData['email'] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Role</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $userData['role'] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Mobile</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $userData['role'] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Last updated</p>
              </div>
              <div class="col-sm-9">
                <p class="text-muted mb-0"><?= $userData['updated_at'] ?></p>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Password</p>
              </div>
              <div class="col-sm-9">
              <button type="button" 
                      class="btn btn-outline-primary ms-1"
                      data-target="#user-password-update"
                      data-toggle="modal"
                      >Update password</button>
              </div>
            </div>
            
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>
    </div>
</div>


<!-- Add new user modal -->
<div class="modal fade" id="user-password-update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Update password</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form method="POST" id="user_update_password">
              <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
							<div class="row">
								<div class="col-12 form-group">
									<label for="full-name">New password</label>
									<input 
										type="password" 
										class="form-control" 
										id="new_password"
										name="new_password" 
										placeholder="New password">
								</div>
								<div class="col-12 form-group">
									<label for="email">Reenter password</label>
									<input 
										type="password" 
										class="form-control" 
										name="re_password" 
										id="re_password" 
										placeholder="Reenter password">
								</div>
								
							</div>
							
							<div class="row my-3">
								<div class="col">
									<button type="submit" name="add_user" class="btn btn-primary w-100">
                    Update</button>
								</div>
							</div>
						</form>
					</div>

					</div>
				</div>
</div>

</body>
</html>