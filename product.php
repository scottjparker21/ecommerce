<?php  require_once 'includes/session.php'; ?>
<?php  require_once 'includes/crud.php'; ?>
<!DOCTYPE html>
	<html lang="en">
		<?php require_once 'includes/header.php';?>
		<body>
			<?php require_once 'includes/navbar.php';?>

				<?php	
					$id = $_GET['productid'];
			  //       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			  //       $sql = "SELECT * FROM product WHERE id = ? ";
			  //       $q = $pdo->prepare($sql);
			  //       $q->execute(array($id));
			  //       $data = $q->fetch(PDO::FETCH_ASSOC);
			  //       $name = $data['name'];
			  //       $cost = $data['cost'];
			  //       $description = $data['description']; 
				$productInfo = new Product($id);
				$pInfo = $productInfo->getProduct();
			?>
			<?php
					// $id = $_GET['productid'];
					// $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					// $sql = "SELECT * FROM image WHERE product_id = ?";
					// $q = $pdo->prepare($sql);
					// $q->execute(array($id));
				 //    $data = $q->fetch(PDO::FETCH_ASSOC);
					// $image = $data['image'];
					// $imagedescription = $data['description'];
			?>		     	
				<div class="container">	
					<div id="content">
						<div class="row">
							<div class="col-lg-12 product-info">
								<div class="col-lg-6">
									<div class="row">
										<div class="col-lg-12">
											<h2><?php echo $pInfo[0]['name']; ?></h2>
										</div>
										<div class="col-lg-12">
											<form method="post" action="add_item.php">
			     								<input type="hidden" name="id" value="<?php echo $id ;?>">'
												<button type="submit" value="add">Add to Cart</button>
											</form>	
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<h2>Cost:&nbsp <?php echo $pInfo[0]['cost']; ?> </h2>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											<h4> <?php echo $pInfo[0]['description']; ?> </h4>
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<center><img src="data:image/jpeg;base64,<?php echo base64_encode( $pInfo[0]['image'] ); ?>" class="img-responsive" alt=" <?php echo $pInfo[0]['imagedescription']; ?> "/><center>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php require_once 'includes/footer.php';?>
		</body>
	</html>
