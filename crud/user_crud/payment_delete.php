
<?php

    ini_set('display_errors', 'On');
    error_reporting(E_ALL);

        // DELETE PAGE
    require_once '../../includes/database.php';
     
    
    if ( !empty($_POST)) {
        // keep track post values
            $id = $_POST['id'];
        
            
        try{
            // delete data
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "DELETE FROM customer_payment  WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($id));

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
