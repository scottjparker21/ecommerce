

<?php

        // DELETE PAGE
    require_once '../../database.php';
     
     
    if (!empty($_POST['id']) && isset($_POST['id'])) {
        // keep track post values
        $id = $_POST['id'];

     try{    
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM image WHERE product_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));

        $sql2 = "DELETE FROM product_tag WHERE product_id = ?";
        $q2 = $pdo->prepare($sql2);
        $q2->execute(array($id));

        $sql3 = "DELETE FROM transaction_item WHERE product_id = ?";
        $q3 = $pdo->prepare($sql3);
        $q3->execute(array($id));

        $sql5 = "DELETE FROM product_bin WHERE product_id = ?";
        $q5 = $pdo->prepare($sql5);
        $q5->execute(array($id));

        $sql4 = "DELETE FROM product  WHERE id = ?";
        $q4 = $pdo->prepare($sql4);
        $q4->execute(array($id));

        Database::disconnect();
        header("Location: index.php");
         
    }  catch (PDOException $e){
        Database::disconnect();
        echo $e->getMessage();
        die();
    }
} else {
    echo "failed.";
    die();
}

 
