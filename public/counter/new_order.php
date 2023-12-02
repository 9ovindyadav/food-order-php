<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once('head.php') ?>
</head>
<body>
	
<?php require_once('header.php') ?>

<div class="main">
	<div class="report-container">
		<form method="POST" id="order-form">
		<input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
		<section>
			<div class="dinning-table-container">
				<fieldset class="checkbox-group" id="menu-list">
					<!-- <legend class="checkbox-group-legend">Select items</legend> -->
					<?php $menuList = $data ?>
					<?php foreach($menuList as $menu): ?>
						<div class="checkbox">
							<label class="checkbox-wrapper">
							<input type="checkbox" name="menu[]" value="<?= $menu['name'].' / '.$menu['price'].'/'.$menu['id'] ?>" class="checkbox-input" />
							<span class="checkbox-tile">
								<span class="checkbox-icon "> 
								<img class="img-thumbnail" src="<?= $menu['img'] ?>"> 
								</span>
								<span class="checkbox-label">
									<h6><?= $menu['name'] ?></h6>
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
			<h4 class="text-center">Order Preview</h4>
			<div class="ml-5" id="order-prev">
				<h2 id="order-prev-table"></h2>
				<hr>
				<table class="table">
					<thead>
						<tr>
							<th>Sr no</th>
							<th>Name</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody id="orderTableBody" class="table-group-divider table-divider-color">

					</tbody>
					<tfoot>
						<tr>	
							<td></td>
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

	</div>
</div>
</body>
</html>