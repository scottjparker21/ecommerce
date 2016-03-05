

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
        echo $e->getMessage();
        $error = $e->getMessage();
        echo $error;
        if(strpos($e, 'CONSTRAINT') !== false) {  
            $error = 'Products currently using this Subcategory. Go to products and delete any using this subcategory in order to delete.';
            echo $error;
        die();
        }
    }
} else {
    echo "failed.";
    die();
}


 
