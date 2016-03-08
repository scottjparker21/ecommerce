<?php
    require_once '../../includes/database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $costError = null;
        $descriptionError = null;
        $subidError = null;
        $binidError = null;       
        // keep track post values
        $name = $_POST['name'];
        $cost = $_POST['cost'];
        $description = $_POST['description'];
        $subid = $_POST['subcategory_id'];
        $binid = $_POST['bin_id'];
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
        if (empty($cost)) {
            $costError = 'Please enter Cost';
            $valid = false;
        }
        if (empty($description)) {
            $descriptionError = 'Please enter Description';
            $valid = false;
        }

        if (empty($subid)) {
            $subidError = 'Please enter Subcategory id';
            $valid = false;
        }
        if (empty($binid)) {
            $binidError = 'Please enter Bin id';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO product (name,cost,description,subcategory_id) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$cost,$description,$subid));

            $last_id = $pdo->lastInsertId();

            $sql2 = "INSERT INTO image (image,description,featured,product_id) values(?, ?, ?, ?)";
            $q2 = $pdo->prepare($sql2);
            $q2->execute(array($name,$cost,$description,$last_id));

            $sql3 = "INSERT INTO product_bin (product_id,bin_id) values(?, ?)";
            $q3 = $pdo->prepare($sql3);
            $q3->execute(array($last_id,$binid));


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
                        <h3>Create a Product</h3>
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
                      <div class="control-group <?php echo !empty($costError)?'error':'';?>">
                        <label class="control-label">Cost</label>
                        <div class="controls">
                            <input name="cost" type="text" placeholder="Cost" value="<?php echo !empty($cost)?$cost:'';?>">
                            <?php if (!empty($costError)): ?>
                                <span class="help-inline"><?php echo $costError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <input name="description" type="text"  placeholder="Description" value="<?php echo !empty($description)?$description:'';?>">
                            <?php if (!empty($descriptionError)): ?>
                                <span class="help-inline"><?php echo $descriptionError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <label class="control-label">Subcategory ID</label>
                      <br>
                        <select name="subcategory_id">
                            <?php
                                $pdo = Database::connect();
                                $sql = 'SELECT * FROM subcategory ORDER BY id DESC';                         
                                   foreach ($pdo->query($sql) as $row) {
                                            echo '<option name="subcategory_id" value="' . $row["id"] . '">' . $row["name"] . '</option>';
                                  }
                                   Database::disconnect();
                                  ?>
                        </select>
                      <br>
                      <label class="control-label">Bin ID</label>
                      <br>
                        <select name="bin_id">
                            <?php
                                $pdo = Database::connect();
                                $sql = 'SELECT * FROM bin ORDER BY id DESC';                         
                                   foreach ($pdo->query($sql) as $row) {
                                            echo '<option name="bin_id" value="' . $row["id"] . '">' . $row["name"] . '</option>';
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
