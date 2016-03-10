<?php

        // DELETE PAGE
    require_once '../../includes/database.php';  
    require_once '../../includes/crud.php';

    session_start();  
     
    if ( !empty($_POST)) {
        // keep track post values
        $address_id = $_POST['id'];
        $address = new customerAddress($_SESSION['user_id']);
        $response = $addy->delete($address_id);
    
    } else {
        echo "failed.";
        die();
    }
         
    
