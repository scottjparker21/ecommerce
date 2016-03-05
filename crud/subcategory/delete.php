

<?php

        // DELETE PAGE
    require_once '../../includes/database.php';
    
 
if (!empty($_POST['id']) && isset($_POST['id'])) {
    // keep track post values
    $id = $_POST['id'];
         
    try{
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM subcategory WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));

        Database::disconnect();
        header("Location: index.php");
         
    } catch (PDOException $e){
        Database::disconnect();
        if(strpos($e->getMessage(), 'Constraint') !== false) {
            echo $e->getMessage();
        $error = 'Products currently using this Subcategory. Go to products and delete any using this subcategory in order to delete.'
        echo $error;
        die();
    }
    }
} else {
    echo "failed.";
    die();
}

?>
 
<!DOCTYPE html>
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
                        <h3>Delete a Subcategory</h3>
                    </div>
                     
                    <form class="form-horizontal" action="delete.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="index.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>