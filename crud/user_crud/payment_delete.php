
<?php

    require_once '../../includes/database.php';  
    require_once '../../includes/crud.php';

    session_start();
      
    if ( !empty($_POST)) {
    
        $payment = new customerPayment($_SESSION['userid']);
        $response = $payment->delete($_POST['id']);
        header("Location: ../../customer.php");
    }   else {
            echo "failed.";
            die();  
        }


