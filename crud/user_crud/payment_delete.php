
<?php

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

        // DELETE PAGE
    require_once '../../includes/database.php';
     
    
    if ( !empty($_POST)) {
        // keep track post values
        $id = $_POST['id'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM customer_payment  WHERE customer_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));

        Database::disconnect();
        header("Location: ../../customer.php");
         
    }
?>