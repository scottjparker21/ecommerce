<?php  require_once 'includes/session.php'; ?>
<!DOCTYPE html>
	<html lang="en">
		<?php require_once 'includes/header.php';?>
		<body>
			<?php require_once 'includes/navbar.php';?>

				<p> <?php echo "<p>" . $_GET['catid'] . "</p>"; ?> 

			<?php	
					$id = $_GET['catid'];
			        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			        $sql = "SELECT id, name FROM subcategory WHERE category_id = ? ";
			        $q = $pdo->prepare($sql);
			        $q->execute(array($id));

			        $subcategories = $q->fetchAll();
			        // print_r($catinfo);
			    
			?>
					<h3> Subcategories </h3>

			       <?php foreach ($subcategories as $row){?>

			       				{?><li id="<?php echo $row['id'];?>"><a href="subcategory.php?subcatid=<?php echo $row['id'];?>"><?php echo $row['name'];?></a>

			       	<?php } ?>
        											
        			
       
			

			<?php require_once 'includes/footer.php';?>
		</body>
	</html>

