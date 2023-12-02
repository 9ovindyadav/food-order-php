<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<script defer src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/css/bootstrap-4.6.2/css/bootstrap.css">
	<script defer src="/css/bootstrap-4.6.2/js/bootstrap.bundle.js"></script>	

	<link rel="stylesheet" href="/css/index.css">
	<script defer src="/js/users.js"></script>	
</head>
<body>
	<div class="container login-page">
		<div class="row">
			<div class="col-md-8 mx-auto form-container">
				<form action="/login" method="POST" id="login_form">
					<h3 class="text-center">Login </h3>
					<p class="text-center">Enter your details to login in to the system.</p>
					<div class="row">
						
						<div class="col-12 form-group">
						      <label for="email">Email address</label>
						      <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
						</div>
						<div class="col-12 form-group">
						    <label for="password">Password</label>
						    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password">
						</div>
						<div class="col-12">
							<button type="submit" class="btn btn-primary w-100">Login</button>
						</div>
					</div>
		
				</form>
			</div>
		</div>
	</div>
</body>
</html>