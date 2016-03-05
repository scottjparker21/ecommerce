<?php
    require_once '../../includes/database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        
        $nameError = null;
        $shipment_center_idError = null;
        
         
        // keep track post values
        $name = $_POST['name'];
        $shipment_center_id = $_POST['shipment_center_id'];
        
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
        if (empty($shipment_center_id)) {
            $shipment_center_idError = 'Please enter Shipment Center id';
            $valid = false;
        }
        
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO bin (name,shipment_center_id) VALUES(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$shipment_center_id));

            $last_id = $pdo->lastInsertId();


           

            $sql2 = "INSERT INTO product_bin (product_id,bin_id) VALUES(?, ?)";
            $q2 = $pdo->prepare($sql2);
            $q2->execute(array($product_id,$last_id));


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
                        <h3>Create a Bin</h3>
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
                      <label class="control-label">Shipment Center ID</label>
                      <br>
                        <select name="shipment_center_id">
                            <?php
                                $pdo = Database::connect();
                                $sql = 'SELECT * FROM shipment_center ORDER BY id DESC';                         
                                   foreach ($pdo->query($sql) as $row) {
                                            echo '<option name="shipment_center_id" value="' . $row["id"] . '">' . $row["id"] . '</option>';
                                  }
                                   Database::disconnect();
                                  ?>
                        </select>
                      <br>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>

                
                
                 
    </div> <!-- /container -->
  </body>
</html>
