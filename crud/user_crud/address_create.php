<?php

    require_once '../../includes/database.php';
    require_once '../../includes/crud.php';

    session_start();

    $uid = $_SESSION['user_id'];
        echo $uid;
        die();
 
    if ( !empty($_POST)) {

        // keep track post values
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $street_1 = $_POST['street_1'];
        $street_2 = $_POST['street_2'];

        $uid = $_SESSION['user_id'];
        echo $uid;
        die();
        // validate input     
         
        // insert data
            $address = new customerAddress($_SESSION['user_id']);

            $response = $address->create($city, $state, $zip, $street_1, $street_2);
            header("Location: ../../customer.php");

    } 
    
?>

<!DOCTYPE html>
<!-- NEW CREATE PAGE -->
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Address</h3>
                    </div>
             
                    <form class="form-horizontal" action="address_create.php" method="post">
                      <div class="control-group <?php echo !empty($cityError)?'error':'';?>">
                        <label class="control-label">City</label>
                        <div class="controls">
                            <input name="city" type="text"  placeholder="City" value="<?php echo !empty($city)?$city:'';?>">
                            <?php if (!empty($cityError)): ?>
                                <span class="help-inline"><?php echo $cityError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($stateError)?'error':'';?>">
                        <label class="control-label">State</label>
                        <div class="controls">
                            <input name="state" type="text" placeholder="State" value="<?php echo !empty($state)?$state:'';?>">
                            <?php if (!empty($stateError)): ?>
                                <span class="help-inline"><?php echo $stateError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($zipError)?'error':'';?>">
                        <label class="control-label">Zip</label>
                        <div class="controls">
                            <input name="zip" type="text"  placeholder="Zip" value="<?php echo !empty($zip)?$zip:'';?>">
                            <?php if (!empty($zipError)): ?>
                                <span class="help-inline"><?php echo $zipError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                        <div class="control-group <?php echo !empty($street_1Error)?'error':'';?>">
                        <label class="control-label">Street 1</label>
                        <div class="controls">
                            <input name="street_1" type="text" placeholder="Street 1" value="<?php echo !empty($street_1)?$street_1:'';?>">
                            <?php if (!empty($street_1Error)): ?>
                                <span class="help-inline"><?php echo $street_1Error;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($street_2Error)?'error':'';?>">
                        <label class="control-label">Street 2</label>
                        <div class="controls">
                            <input name="street_2" type="text"  placeholder="Street 2" value="<?php echo !empty($street_2)?$street_2:'';?>">
                            <?php if (!empty($street_2Error)): ?>
                                <span class="help-inline"><?php echo $street_2Error;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>