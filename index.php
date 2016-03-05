<?php  require_once 'includes/session.php'; ?>
<!DOCTYPE html>
	<html lang="en">
		<?php require_once 'includes/header.php';?>
		<body>
			<?php require_once 'includes/navbar.php';?>
			<div class="results"></div>	
			<div id="content">

				<?php echo $_SESSION['first']; ?>

				<p> This will hopefully been hidden when search field is not empty. </p>
				<i class="fa fa-camera-retro fa-lg"></i>


			</div>
			<?php require_once 'includes/footer.php';?>

		</body>
	</html>