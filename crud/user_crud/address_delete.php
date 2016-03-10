<?php

        // DELETE PAGE
    require_once '../../includes/database.php';  
    require_once '../../includes/crud.php';

    session_start();  
     
    if ( !empty($_POST)) {

        $address = new customerAddress($_SESSION['userid']);
        $response = $address->delete($_POST['id']);
        header('Location: ../../customer.php');
    
    } else {
        echo "failed.";
        die();
    }
         
    
