<?php
    
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    // echo "im here";
    require_once '../../includes/database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errorss
        $nameError = null;
        $shipment_center_idError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($category_id)) {
            $category_idError = 'Please enter Category id';
            $valid = false;
        } 
         
        // update data
        if ($valid) {
            // echo "in the connect";
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE subcategory  set name = ?, category_id = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$category_id,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        // echo "are you there?";
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM subcategory where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['name'];
        $category_id = $data['category_id'];
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
                        <h3>Update a Subcategory</h3>
                    </div>
             
                    <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($category_id)?'error':'';?>">
                        <label class="control-label">Category id</label>
                        <div class="controls">
                            <input name="category_id" type="text" placeholder="Category id" value="<?php echo !empty($category_id)?$category_id:'';?>">
                            <?php if (!empty($category_idError)): ?>
                                <span class="help-inline"><?php echo $category_idError;?></span>
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

