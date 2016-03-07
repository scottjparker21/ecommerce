<?php  require_once 'includes/session.php'; ?>
<!DOCTYPE html>
	<html lang="en">
		<?php require_once 'includes/header.php';?>
		<body>
			<?php require_once 'includes/navbar.php';?>
			<div class="container">
		
				<h3>Admin Page</h3>

				<ul>
				  <li><a href="crud/address/index.php">Address</a></li>
				  <li><a href="crud/bin/index.php">Bin</a></li>
				  <li><a href="crud/category/index.php">Category</a></li>
				  <li><a href="crud/customer/index.php">Customer</a></li>
				  <li><a href="crud/payment/index.php">Payment</a></li>
				  <li><a href="crud/product/index.php">Product</a></li>
				  <li><a href="crud/shipment_center/index.php">Shipment_center</a></li>
				  <li><a href="crud/subcategory/index.php">Subcategory</a></li>
				  <li><a href="crud/tag/index.php">Tag</a></li>
				</ul>
				
			</div>
			<?php require_once 'includes/footer.php';?>

		</body>
	</html>