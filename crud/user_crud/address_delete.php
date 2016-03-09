<?php

        // DELETE PAGE
    require_once '../../includes/database.php';  

    session_start();  
  
    if ( !empty($_POST))
        // keep track post values
        $addy_id = $_POST['id'];
        echo $addy_id;
        echo $_SESSION['userid'];
    try {
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM customer_address WHERE customer_id = ? AND address_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($_SESSION['userid'],$addy_id));
        Database::disconnect();
        // header("Location: ../../customer.php");
    } catch (PDOException $e){
        Database::disconnect();
        echo $e->getMessage();
        die();
        }
    } else {
        echo "failed.";
        die();
    }
         
    
