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
         $card_full_nameError = null;
        $card_numberError = null;
        $card_securityError = null;
        $expires_monthError = null;
        $expires_yearError = null;
        $typeError = null;
         
        // keep track post values
        $card_full_name = $_POST['card_full_name'];
        $card_number = $_POST['card_number'];
        $card_security = $_POST['card_security'];
        $expires_month = $_POST['expires_month'];
        $expires_year = $_POST['expires_year'];
        $type = $_POST['type'];
         
        // validate input
        $valid = true;
        if (empty($card_full_name)) {
            $card_full_nameError = 'Please enter Full Name';
            $valid = false;
        }
        if (empty($card_number)) {
            $card_numberError = 'Please enter Card Number';
            $valid = false;
        }
        if (empty($card_security)) {
            $card_securityError = 'Please enter Card Security Number';
            $valid = false;
        }

        if (empty($expires_month)) {
            $expires_monthError = 'Please enter Expiration Month';
            $valid = false;
        }

        if (empty($expires_year)) {
            $expires_yearError = 'Please enter Expiration Year';
            $valid = false;
        }

        if (empty($type)) {
            $typeError = 'Please enter Card Type';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            // echo "in the connect";
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE payment  set card_full_name = ?, card_number = ?, card_security = ?, expires_month = ?, expires_year = ?, type = ?  WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($card_full_name,$card_number,$card_security,$expires_month,$expires_year,$type,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        // echo "are you there?";
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM payment where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $card_full_name = $data['card_full_name'];
        $card_number = $data['card_number'];
        $card_security = $data['card_security'];
        $expires_month = $data['expires_month'];
        $expires_year = $data['expires_year'];
        $type = $data['type'];
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
                        <h3>Update Payment Information</h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
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
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>

