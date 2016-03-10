<?php
    
    
    require_once '../../includes/database.php';  
    require_once '../../includes/crud.php';

    session_start();

    if (!empty($_POST)) {
     
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $street_1 = $_POST['street_1'];
        $street_2 = $_POST['street_2'];
        $id = $_POST['id'];

        
        $address = new customerAddress($_SESSION['userid']);
        $response = $address->update($city, $state, $zip, $street_1, $street_2,$id);
        header("Location: ../../customer.php");

    } else {
        echo "failed.";
        die();
    }
    