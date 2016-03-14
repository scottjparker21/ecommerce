<?php  require_once 'includes/session.php'; ?>
<!DOCTYPE html>
	<html lang="en">
		<?php require_once 'includes/header.php';?>
		<body>
			<?php require_once 'includes/navbar.php';?>
			<div class="results"></div>	
			<div id="content">
			<?php
				//store uid and pid and quantity in session variables
				//when viewing cart call all variables containing uid 
				//use pid to retreive info from database

				if (!empty($_SESSION['cart'] && isset($_SESSION['cart'])) {

					$_SESSION['user_cart'] = TRUE;			
				}
				
				if ($_SESSION['user_cart']) {

					
					
				}

			?>
			</div>
			<?php require_once 'includes/footer.php';?>

		</body>
	</html>