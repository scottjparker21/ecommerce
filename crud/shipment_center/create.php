<?php
    require_once '../../includes/database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $phoneError = null;
        $address_idError = null;
       
         
        // keep track post values
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address_id = $_POST['address_id'];
       
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
        if (empty($phone)) {
            $phonecostError = 'Please enter Phone';
            $valid = false;
        }
        if (empty($address_id)) {
            $address_id = 'Please enter Address id';
            $valid = false;
        }

       
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO shipment_center (name,phone,address_id) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$phone,$address_id));
            Database::disconnect();
            header("Location: index.php");
        }
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
                        <h3>Create a Shipment Center</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($phoneError)?'error':'';?>">
                        <label class="control-label">Phone</label>
                        <div class="controls">
                            <input name="phone" type="text" placeholder="Phone" value="<?php echo !empty($phone)?$phone:'';?>">
                            <?php if (!empty($phoneError)): ?>
                                <span class="help-inline"><?php echo $phoneError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($address_idError)?'error':'';?>">
                        <label class="control-label">Address id</label>
                        <div class="controls">
                            <input name="address_id" type="text"  placeholder="Address id" value="<?php echo !empty($address_id)?$address_id:'';?>">
                            <?php if (!empty($address_idError)): ?>
                                <span class="help-inline"><?php echo $address_idError;?></span>
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
