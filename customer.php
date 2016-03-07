<?php  require_once 'includes/session.php'; ?>
<!DOCTYPE html>
	<html lang="en">
		<?php require_once 'includes/header.php';?>
		<body>
			<?php require_once 'includes/navbar.php';

			echo "i work";?>
				<div class="container">
					<div class="span10 offset1">
		                    <div class="row">
		                        <h3>Create Payment Information</h3>
		                    </div>
		             
		                    <form class="form-horizontal" action="create.php" method="post">
		                      <div class="control-group <?php echo !empty($card_full_nameError)?'error':'';?>">
		                        <label class="control-label">Full Name</label>
		                        <div class="controls">
		                            <input name="card_full_name" type="text"  placeholder="Full Name" value="<?php echo !empty($card_full_name)?$card_full_name:'';?>">
		                            <?php if (!empty($card_full_nameError)): ?>
		                                <span class="help-inline"><?php echo $card_full_nameError;?></span>
		                            <?php endif; ?>
		                        </div>
		                      </div>
		                      <div class="control-group <?php echo !empty($card_numberError)?'error':'';?>">
		                        <label class="control-label">Card Number</label>
		                        <div class="controls">
		                            <input name="card_number" type="text" placeholder="Card Number" value="<?php echo !empty($card_number)?$card_number:'';?>">
		                            <?php if (!empty($card_numberError)): ?>
		                                <span class="help-inline"><?php echo $card_numberError;?></span>
		                            <?php endif;?>
		                        </div>
		                      </div>
		                      <div class="control-group <?php echo !empty($card_securityError)?'error':'';?>">
		                        <label class="control-label">Card Security Number</label>
		                        <div class="controls">
		                            <input name="card_security" type="text"  placeholder="Security Number" value="<?php echo !empty($card_security)?$card_security:'';?>">
		                            <?php if (!empty($card_securityError)): ?>
		                                <span class="help-inline"><?php echo $card_securityError;?></span>
		                            <?php endif;?>
		                        </div>
		                      </div>
		                        <div class="control-group <?php echo !empty($expires_monthError)?'error':'';?>">
		                        <label class="control-label">Expiration Month</label>
		                        <div class="controls">
		                            <input name="expires_month" type="text" placeholder="Expiration Month" value="<?php echo !empty($expires_month)?$expires_month:'';?>">
		                            <?php if (!empty($expires_monthError)): ?>
		                                <span class="help-inline"><?php echo $expires_monthError;?></span>
		                            <?php endif;?>
		                        </div>
		                      </div>
		                      <div class="control-group <?php echo !empty($expires_yearError)?'error':'';?>">
		                        <label class="control-label">Expiration Year</label>
		                        <div class="controls">
		                            <input name="expires_year" type="text"  placeholder="Expiration Year" value="<?php echo !empty($expires_year)?$expires_year:'';?>">
		                            <?php if (!empty($expires_yearError)): ?>
		                                <span class="help-inline"><?php echo $expires_yearError;?></span>
		                            <?php endif;?>
		                        </div>
		                      </div>
		                      <div class="control-group <?php echo !empty($typeError)?'error':'';?>">
		                        <label class="control-label">Card Type</label>
		                        <div class="controls">
		                            <input name="type" type="text"  placeholder="Card Type" value="<?php echo !empty($type)?$type:'';?>">
		                            <?php if (!empty($typeError)): ?>
		                                <span class="help-inline"><?php echo $typeError;?></span>
		                            <?php endif;?>
		                        </div>
		                      </div>
		                      <div class="form-actions">
		                          <button type="submit" class="btn btn-success">Create</button>
		                          <a class="btn" href="index.php">Back</a>
		                        </div>
		                    </form>
		                </div>
		                <div class="row">
		                <h3>Payment</h3>
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

		                   $sql2 = 'SELECT payment_id FROM customer_payment WHERE customer_id = ? ';

		                   foreach ($pdo->query($sql2) as $row2) {

						    
					        $payment_id = $row2["payment_id"];

					        echo $payment_id;

		                   
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