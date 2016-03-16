<?php  require_once 'includes/session.php'; ?>
<?php  require_once 'includes/crud.php'; ?>
<!DOCTYPE html>
	<html lang="en">
		<?php require_once 'includes/header.php';?>
		<body>
			<?php require_once 'includes/navbar.php';?>
			<div id="container">
			<div class="results"></div>	
				<div id="content">
		            <h3>Cart</h3>
				        <table class="table table-striped table-bordered">
		                  <thead>
		                    <tr>
		                      <th>name</th>
		                      <th>cost</th>
		                      <th>description</th>
		                      <th>quantity</th>
		                      <th></th>
		                    </tr>
		                  </thead>
		                  <tbody>
							<?php
										$user_cart = new cart();
										$user_cart->fetchCart();
										$cart_data = $user_cart->fetchCart();
										$subtotal = 0;

										foreach ($cart_data as $item) {
												echo '<tr>';
					                            echo '<form action="cart_update.php" method="post">';
					                            echo '<td>' . $item["name"] . '</td>';
					                            echo '<td>' . $item["cost"] . '</td>';
					                            echo '<td>' . $item["description"] . '</td>';
					                          	echo '<td><input type="text" name="quantity" value="' . $item["quantity"] . '"></td>';

					                            echo '<input type="hidden" name="id" value="'.$item["product_id"].'">';
					                            echo '<input type="hidden" name="transaction_item_id" value="'.$item["transaction_item_id"].'">';

					                            echo '<td>';
					                            echo '<input type="submit" class="" value="update">'; //to update quantity
					                            echo '</form>';       
					                            echo '<form action="delete.php" method="post">';
					                            echo '<input type="hidden" name="id" value="'.$item["product_id"].'">';
					                            echo '<input type="submit" class="btn-danger" value="delete">';
					                            echo '</form>';
					                            echo '</td>';
					                            echo '</tr>';
					                            $subtotal = $subtotal + ($item["cost"] * $item["quantity"]);
										}
									echo '<h3>' . "Subtotal = $ " . $subtotal . " " . '</h3>';

							?>		
								<form method="post" action="checkout.php">
								    <button type="submit" value="checkout">Checkout</button>
								</form>				                  
					       </tbody>
					    </table>
					</div>
				</div>
			</div>
			<?php require_once 'includes/footer.php';?>

		</body>
	</html>