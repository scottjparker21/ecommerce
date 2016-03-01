<?php
    
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    // echo "im here";
    require_once '../../database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errorss
        $cityError = null;
        $stateError = null;
        $zipError = null;
        $street_1Error = null;
        $street_2Error = null;
         
        // keep track post values
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $street_1 = $_POST['street_1'];
        $street_2 = $_POST['street_2'];
         
        // validate input
        $valid = true;
        if (empty($city)) {
            $cityError = 'Please enter City';
            $valid = false;
        }
         
        if (empty($state)) {
            $stateError = 'Please enter State';
            $valid = false;
        } 
         
        if (empty($zip)) {
            $zipError = 'Please enter Zip';
            $valid = false;
        }
        if (empty($street_1)) {
            $street_1Error = 'Please enter Street 1';
            $valid = false;
        } 
         if (empty($street_2)) {
            $street_2Error = 'Please enter Street 2';
            $valid = false;
        } 
         
        // update data
        if ($valid) {
            // echo "in the connect";
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE address  set city = ?, state = ?, zip = ?, street_1 = ?, street_2 = ?  WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($city,$state,$zip,$street_1,$street_2,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        // echo "are you there?";
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM address where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $city = $data['city'];
        $state = $data['state'];
        $zip = $data['zip'];
        $street_1 = $data['street_1'];
        $street_2 = $data['street_2'];
        Database::disconnect();
    }
?>


<!DOCTYPE html>
<!-- UPDATE PHP -->
<html lang="en">
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update an Address</h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
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
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>

