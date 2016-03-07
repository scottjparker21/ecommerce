<?php  require_once 'includes/session.php'; ?>
<!DOCTYPE html>
	<html lang="en">
		<?php require_once 'includes/header.php';?>
		<body>
			<?php require_once 'includes/navbar.php'; ?>

			
		            <div class="row">
		                <h3>Payment</h3>
		                <br>
		                <p>
							<a href="crud/user_crud/customerpayment.php" class="btn btn-success"> Add New Payment Option </a>
						</p>	
		            </div>
		            <div class="row">		
		                <table class="table table-striped table-bordered">
		                  <thead>
		                    <tr>
		                      <th>Full Name</th>
		                      <th>Card Number</th>
		                      <th>Security Number</th>
		                      <th>Expiration Month</th>
		                      <th>Expiration Year</th>
		                      <th>Type</th>
		                    </tr>
		                  </thead>
		                  <tbody>
		                  <?php

		                  	$uid = $_SESSION["userid"];
		                   
		                   $pdo = Database::connect();

		                   $sql2 = "SELECT * FROM customer_payment WHERE customer_id = '$uid' ";
		                 
		                   foreach ( $pdo->query($sql2) as $row2) {
    
					        $payment_id = $row2["payment_id"];

			                   $sql = 'SELECT * FROM payment ORDER BY id DESC';
			                   // $sql = 'SELECT * FROM payment JOIN customer_payment ON (id=payment_id) WHERE'
			                   foreach ($pdo->query($sql) as $row) {

			                   		if ( $row["id"] == $payment_id) {
			                            echo '<tr>';
			                            echo '<form action="crud/payment/update.php" method="post">';

			                            echo '<td><input type="text" name="card_full_name" value="' . $row["card_full_name"] . '"></td>';
			                            echo '<td><input type="text" name="card_number" value="' . $row["card_number"] . '"></td>';
			                            echo '<td><input type="text" name="card_security" size="3" value="' . $row["card_security"] . '"></td>';
			                            echo '<td><input type="text" name="expires_month" size="2" value="' . $row["expires_month"] . '"></td>';
			                            echo '<td><input type="text" name="expires_year" size="4" value="' . $row["expires_year"] . '"></td>';
			                            echo '<td><input type="text" name="type" value="' . $row["type"] . '"></td>';
			                            
			                            echo '<input type="hidden" name="id" value="'.$row["id"].'">';
			            
			                            echo '<td>';
			                              echo '<input type="submit" class="btn-success" value="update">';
			                              echo '</form>';
			          
			                              echo '<form action="delete.php" method="post">';
			                              echo '<input type="hidden" name="id" value="'.$row["id"].'">';
			                              echo '<input type="submit" class="btn-danger" value="delete">';
			                              echo '</form>';
			                            echo '</td>';
			                           echo '</tr>';
			                        }
		                    	}
		                    }
		                   Database::disconnect();
		                  ?>
		                  </tbody>
		            </table>
		        </div>
		    </div>
		

				
			
			<?php require_once 'includes/footer.php';?>

		</body>
	</html>