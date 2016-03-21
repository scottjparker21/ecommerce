

			<?php

					require 'includes/database.php';
					$pdo = Database::connect();
					$got = $_GET['entry'];
					$id = '%' . $got . '%';
			        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			        $sql = "SELECT * FROM product WHERE name  LIKE ? ";
			        $q = $pdo->prepare($sql);
			        $q->execute(array($id));
			        $product = $q->fetchAll();
			        Database::disconnect(); 

					// echo $_GET['entry'];
					$results = "";

		       		foreach ($product as $row){ 

			       	   $results .= "<li id='" . $row['id'] . "'>";
			       	   $results .= "<a href='product.php?productid='" . $row['id'] . "'>";
			       	   $results .= $row['name'];
			       	   $results .= "</a>";
			     
		       		} 

		       		echo $results;
		       		
			?>

