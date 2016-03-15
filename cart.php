<?php  require_once 'includes/session.php'; ?>
<?php  require_once 'includes/crud.php'; ?>
<!DOCTYPE html>
	<html lang="en">
		<?php require_once 'includes/header.php';?>
		<body>
			<?php require_once 'includes/navbar.php';?>
			<div class="results"></div>	
			<div id="content">
				<h2> Cart </h2>

					<?php
					$pdo = Database::connect();
					$user_cart = new cart();

					$cart_data = $user_cart->fetchCart();

					foreach ($cart_data as $item) {
									echo '<tr>';
		                            echo '<form action="update.php" method="post">';
		                            echo '<td>' . $row["product_id"] . '</td>';
		                            echo '<td>' . $row["name"] . '</td>';
		                            echo '<td>' . $row["cost"] . '</td>';
		                            echo '<td>' . $row["description"] . '</td>';
		                            echo '<td>'.$row["quantity"].'</td>';                            
		                            echo '<td>';
		                            echo '<input type="submit" class="" value="update">';
		                            echo '</form>';       
		                            echo '<form action="delete.php" method="post">';
		                            echo '<input type="hidden" name="id" value="'.$row["id"].'">';
		                            echo '<input type="submit" class="btn-danger" value="delete">';
		                            echo '</form>';
		                            echo '</td>';
		                            echo '</tr>';

					}
						Database::disconnect();
					?>

			</div>
			<?php require_once 'includes/footer.php';?>

		</body>
	</html>