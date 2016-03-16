<?php  require_once 'includes/session.php'; ?>
<?php  require_once 'includes/crud.php'; ?>
<!DOCTYPE html>
	<html lang="en">
		<?php require_once 'includes/header.php';?>
		<body>
			<?php require_once 'includes/navbar.php';?>
			<div class="results"></div>	
			<div id="content">
					<div class="row">
		                	<h3>Address</h3>
		            	</div>
				        <table class="table table-striped table-bordered">
		                  <thead>
		                    <tr>
		                      <th>City</th>
		                      <th>State</th>
		                      <th>Zip</th>
		                      <th>Street 1</th>
		                      <th>Street 2</th>
		                    </tr>
		                  </thead>
		                  <tbody>

							<?php
										echo " line 1";
										$user_cart = new cart();
										echo " line 2";
										$user_cart->fetchCart();
										echo " line 3";

										$cart_data = $user_cart->fetchCart();

										foreach ($cart_data as $item) {
												echo '<tr>';
					                            echo '<form action="checkout.php" method="post">';
					                            echo '<td>' . $item["product_id"] . '</td>';
					                            echo '<td>' . $item["name"] . '</td>';
					                            echo '<td>' . $item["cost"] . '</td>';
					                            echo '<td>' . $item["description"] . '</td>';
					                            echo '<td>'. $item["quantity"].'</td>';                            
					                            echo '<td>';
					                            echo '<input type="submit" class="" value="update">';
					                            echo '</form>';       
					                            echo '<form action="delete.php" method="post">';
					                            echo '<input type="hidden" name="id" value="'.$item["id"].'">';
					                            echo '<input type="submit" class="btn-danger" value="delete">';
					                            echo '</form>';
					                            echo '</td>';
					                            echo '</tr>';
										}
										?>					                  
					       </tbody>
					    </table>
					</div>
			</div>
			<?php require_once 'includes/footer.php';?>

		</body>
	</html>