<?php  require_once 'includes/session.php'; ?>
<!DOCTYPE html>
	<html lang="en">
		<?php require_once 'includes/header.php';?>
		<body>
			<?php require_once 'includes/navbar.php';?>
			<div class="container">
		
				<h3>  Information</h3>

					
			            <div class="row">
			                <h3>Payment</h3>
			            </div>
			            <div class="row">
							<p>
								<a href="create.php" class="btn btn-success"> Create </a>
							</p>		
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

			                   $uid =  $_SESSION["userid"];

			                   require_once '../../includes/database.php';
			                   $pdo = Database::connect();

			                   $sql2 = 'SELECT FROM '

			                   $sql = 'SELECT FROM payment WHERE id = $uid ORDER BY id DESC';
			                   foreach ($pdo->query($sql) as $row) {
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
			          
			                              echo '<form action="crud/payment/delete.php" method="post">';
			                              echo '<input type="hidden" name="id" value="'.$row["id"].'">';
			                              echo '<input type="submit" class="btn-danger" value="delete">';
			                              echo '</form>';
			                            echo '</td>';
			                           echo '</tr>';
			                  }
			                   Database::disconnect();
			                  ?>
			                  </tbody>
			            </table>
			        </div>
			    </div> <!-- /container -->

				
			
			<?php require_once 'includes/footer.php';?>

		</body>
	</html>