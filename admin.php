<?php  require_once 'includes/session.php'; ?>
<!DOCTYPE html>
	<html lang="en">
		<?php require_once 'includes/header.php';?>
		<body>
			<?php require_once 'includes/navbar.php';?>
			<div class="container">
		
				<p>Admin Page</p>

				<?php require_once 'crud/address/index.php';?>

				<?php require_once 'crud/address/update.php';?>


			</div>
			<?php require_once 'includes/footer.php';?>

		</body>
	</html>