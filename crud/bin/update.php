<?php
    
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    // echo "im here";
    require_once '../../database.php';

    $id = $_POST['id'];
 
     
    if (!empty($_POST['id']) && isset($_POST['id'])) {
        // keep track validation errorss
        $nameError = null;
        $shipment_center_idError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $shipment_center_id = $_POST['shipment_center_id'];
        
         
        // validate input
        $valid = true;
        
        if (!empty($_POST['name']) && isset($_POST['name'])) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (!empty($_POST['shipment_center_id']) && isset($_POST['shipment_center_id'])) {
            $shipment_center_idError = 'Please enter Shipment Center id';
            $valid = false;
        } 
         
        // update data
        try {
            // echo "in the connect";
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE bin  set name = ?, shipment_center_id = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$shipment_center_id,$id));
            Database::disconnect();
            header("Location: index.php");
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


