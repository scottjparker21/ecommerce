<?php

        // DELETE PAGE
    require_once '../../includes/database.php';  
    require_once '../../includes/crud.php';

    session_start();  
     
    if ( !empty($_POST)) {
        // keep track post values

        $address = new customerAddress($_SESSION['user_id']);
        $response = $address->delete($_POST['id']);
    
    } else {
        echo "failed.";
        die();
    }
         
    
