
<?php

// DELETE PAGE
require_once '../../includes/database.php';
    
if ( !empty($_POST['id']) && isset($_POST['id'])) {
    // keep track post values
    
    
    try{
        // delete data
        $pdo = Database::connect();
        $id = $_POST['id'];
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM product_bin WHERE bin_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));

        $sql = "DELETE FROM bin WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        
        Database::disconnect();
        header("Location: index.php");
    } catch (PDOException $e){
        Database::disconnect();
        echo $e->getMessage();
        die();
    }
} else {
    echo "failed.";
    die();
}