
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<script defer src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/css/bootstrap-4.6.2/css/bootstrap.css">
	<script defer src="/css/bootstrap-4.6.2/js/bootstrap.bundle.js"></script>	

	<link rel="stylesheet" href="/css/order.css">
	<script defer src="/js/order.js"></script>	

	<link rel="stylesheet" href="/css/index.css">
	<script defer src="/js/index.js"></script>	
</head>
<body>
	<?php require_once __DIR__.'/pages/header.php' ?>

	<form action="/order/create" method="POST" id="order-form">
		<section>
		  <div class="dinning-table-container">
		  	<fieldset class="checkbox-group" id="dinning-table-list">
		  		<legend class="checkbox-group-legend">Choose Table no</legend>
		  		<?php $tablesList = [1,2,3,4,5,6] ?>
		  		<?php foreach($tablesList as $table): ?>
			  		<div class="checkbox">
			  			<label class="checkbox-wrapper">
			  				<input type="checkbox" name="table" value="<?= $table ?>" class="checkbox-input" />
			  				<span class="checkbox-tile">
			  					<span class="checkbox-icon">
			  					</span>
			  					<span class="checkbox-label"><?= $table ?> - Non ac</span>
			  				</span>
			  			</label>
			  		</div>
		  		<?php endforeach ?>
		  	</fieldset>
		  </div>
		</section>

		<section>
			<div class="dinning-table-container">
				<fieldset class="checkbox-group" id="menu-list">
					<legend class="checkbox-group-legend">Menu list</legend>
					<?php $menuList = $data ?>
					<?php foreach($menuList as $menu): ?>
						<div class="checkbox">
						  	<label class="checkbox-wrapper">
						    <input type="checkbox" name="menu[]" value="<?= $menu['name'].' / '.$menu['price'].'/'.$menu['id'] ?>" class="checkbox-input" />
						    <span class="checkbox-tile">
						      	<span class="checkbox-icon "> 
						      	<img src="<?= $menu['img'] ?>"> 
						      	</span>
						      	<span class="checkbox-label">
						        	<h4><?= $menu['name'] ?></h4>
						        	<h6><?= $menu['price'] ?>/-</h6>
						      	</span>
						    </span>
						  </label>
						</div>
					<?php endforeach ?>
				</fieldset>
			</div>
		</section>

		<section>
		 	<h1 class="text-center mb-5">Order Preview</h1>
		 	<div class="ml-5" id="order-prev">
		 		<h2 id="order-prev-table"></h2>
		 		<hr>
		 		<table>
		 		    <thead>
		 		        <tr>
		 		            <th>Name</th>
		 		            <th>Price</th>
		 		        </tr>
		 		    </thead>
		 		    <tbody id="orderTableBody">
	
		 		    </tbody>
		 		    <tfoot>
		 		        <tr>
		 		            <td><strong>Total</strong></td>
		 		            <td id="totalAmount"><strong></strong></td>
		 		        </tr>
		 		    </tfoot>
		 		</table>
		 	</div>
		</section>

		<div class="row text-center">
			<div class="col-6">
				<div class="button" id="prev">&larr; Previous</div>
			</div>
			<div class="col-6">
				<div class="button" id="next">Next &rarr;</div>
				<button class="button" id="submit" type="submit">Confirm order</button>
			</div>
		</div>
	</form>
	

</body>
</html>