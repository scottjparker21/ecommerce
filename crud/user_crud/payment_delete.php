
<?php

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

    session_start();

        // DELETE PAGE
    require_once '../../includes/database.php';
     
    
    if ( !empty($_POST)) {
        // keep track post values
            $pid = $_POST['id'];
        
            
        try{
            // delete data
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM customer_payment  WHERE payment_id = ? AND customer_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($pid,$_SESSION['userid']));

            Database::disconnect();
            header("Location: ../../customer.php");
        }
        catch (PDOException $e){
            Database::disconnect();
            echo $e->getMessage();
            die();
        }  
    } else {
            echo "failed.";
            die();  
    }
