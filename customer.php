<?php  require_once 'includes/session.php'; ?>
<!DOCTYPE html>
	<html lang="en">
		<?php require_once 'includes/header.php';?>
		<body>
			<?php require_once 'includes/navbar.php'; ?>

			<div class="container">
				<div class="row">
                	<h3>Customer</h3>
            	</div>
	            <div class="row">	
	                <table class="table table-striped table-bordered" style="white-space:nowrap;">
	                  <thead>
	                    <tr>
	                      <th>First</th>
	                      <th>Last</th>
			              <th>Phone</th>
	                      <th>Date of Birth</th>
	                      <th>Username</th>
	                      <th>Password</th>
	                      <th>Gender</th>
	                      <th>Email</th>
	                      <th>Actions</th>
	                    </tr>
	                  </thead>
	                  <tbody>
	                  <?php

	                  $uid = $_SESSION["userid"];
	                   
	                   $pdo = Database::connect();
	                   $sql = "SELECT * FROM customer WHERE id = '$uid'";
	                   foreach ($pdo->query($sql) as $row) {
	                            echo '<tr>';
	                            echo '<form action="update.php" method="post">';

	                            echo '<td><input type="text" name="first" value="' . $row["first"] . '"></td>';
	                            echo '<td><input type="text" name="last" value="' . $row["last"] . '"></td>';
	                            echo '<td><input type="text" name="phone" size="12" value="' . $row["phone"] . '"></td>';
	                            echo '<td><input type="text" name="dob" value="' . date('m-d-Y',strtotime($row["dob"])) . '"></td>';
	                            echo '<td><input type="text" name="username" value="' . $row["username"] . '"></td>';
	                            echo '<td><input type="text" name="password" value="' . $row["password"] . '"></td>';
	                            echo '<td><input type="text" name="gender" size="1" value="' . $row["gender"] . '"></td>';
	                            echo '<td><input type="text" name="email" value="' . $row["email"] . '"></td>';
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
	                   Database::disconnect();
	                  ?>
	                  </tbody>
	            	</table>
	        	</div>	
	        		<div class="row">
		                <h3>Payment</h3>
		            </div>	
					<p><a href="crud/user_crud/customer_payment_update.php" class="btn btn-success"> Create </a></p>							
		            
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
		            	</row>
		            	</table>
		        	</div>
		        		<div class="row">
		                	<h3>Address</h3>
		            	</div>
		        		<p>
	        				<a href="create.php" class="btn btn-success"> Create </a>
	        			</p>
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
		                   
		                   $pdo = Database::connect();
		                   $sql = "SELECT * FROM address LEFT JOIN customer_address ON address.id = customer_address.address_id AND customer_address.customer_id ='$uid'";
		                   foreach ($pdo->query($sql) as $row) {
		                            echo '<tr>';
		                            echo '<form action="crud/address/update.php" method="post">';

		                            echo '<td><input type="text" name="city" value="' . $row["city"] . '"></td>';
		                            echo '<td><input type="text" name="state" value="' . $row["state"] . '"></td>';
		                            echo '<td><input type="text" name="zip" size="12" value="' . $row["zip"] . '"></td>';
		                            echo '<td><input type="text" name="street_1" value="' . $row["street_1"] . '"></td>';
		                            echo '<td><input type="text" name="street_2" value="' . $row["street_2"] . '"></td>';
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
		                   Database::disconnect();
		                  ?>
		                  </tbody>
		            </table>
		    </div>
		

					
			<?php require_once 'includes/footer.php';?>

		</body>
	</html>