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
		            <h3>Finalize Order</h3>
				        <table class="table table-striped table-bordered">
		                  <thead>
		                    <tr>
		                      <th>name</th>
		                      <th>cost</th>
		                      <th>description</th>
		                      <th>quantity</th>
		                      
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
					                          	echo '<td>' . $item["quantity"] . '</td>';

					                            echo '<input type="hidden" name="id" value="'.$item["product_id"].'">';
					                            echo '<input type="hidden" name="transaction_item_id" value="'.$item["transaction_item_id"].'">';
					                            echo '</form>';
					                           
					                            echo '</tr>';
					                            $subtotal = $subtotal + ($item["cost"] * $item["quantity"]);
										}

										$user_payment = new cart();

										echo '<select name="credit_card">';
										foreach ($user_payment->fetchPayment() as $credit_card) {
											
                            				echo '<option name="credit_card" value="' . $credit_card["id"] . '">' . $credit_card["type"] . ", " . $credit_card["card_number"] . '</option>';                          
                                			                                    		                                       
            								echo $credit_cart['card_number'];
											echo '<br>';
										}
										echo '</select>';

										echo '<h3>' . "Order Total = $ " . $subtotal . " " . '</h3>';
										echo '<form method="post" action="process_order.php">';
									    echo 	'<button type="submit" value="process_order">Place Order</button>';
										echo '</form>';

										echo '<br>';

										echo '<h3>' . "Choose Payment Option: " . '</h3>';	

							?>		
											                  
					       </tbody>
					    </table>
					</div>
				</div>
			</div>
			<?php require_once 'includes/footer.php';?>

		</body>
	</html>
	