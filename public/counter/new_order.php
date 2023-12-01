<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once('head.php') ?>
</head>
<body>
	
<?php require_once('header.php') ?>

<form method="POST" id="order-form">
	<input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
	<section>
		<div class="dinning-table-container">
			<fieldset class="checkbox-group" id="menu-list">
				<legend class="checkbox-group-legend">Select items</legend>
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