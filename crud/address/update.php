<?php
    
    
    require_once '../../includes/database.php';

    $id = $_POST['id'];
     
    if (!empty($_POST['id']) && isset($_POST['id'])) {
        // keep track validation errorss
        $cityError = null;
        $stateError = null;
        $zipError = null;
        $street_1Error = null;
        $street_2Error = null;
         
        // keep track post values
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $street_1 = $_POST['street_1'];
        $street_2 = $_POST['street_2'];
         
        // validate input
        $valid = true;

        if (empty($city)) {
            $cityError = 'Please enter City';
            $valid = false;
        }
         
        if (empty($state)) {
            $stateError = 'Please enter State';
            $valid = false;
        } 
         
        if (empty($zip)) {
            $zipError = 'Please enter Zip';
            $valid = false;
        }
        if (empty($street_1)) {
            $street_1Error = 'Please enter Street 1';
            $valid = false;
        } 
         if (empty($street_2)) {
            $street_2Error = 'Please enter Street 2';
            $valid = false;
        } 
         
        // update data
        if ($valid == FALSE) {
            echo "failed.";
            die();
        }
            try {
            // echo "in the connect";
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE address  set city = ?, state = ?, zip = ?, street_1 = ?, street_2 = ?  WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($city,$state,$zip,$street_1,$street_2,$id));
            Database::disconnect();
            header("Location: index.php");

            }
            catch (PDOException $e){
                Database::disconnect();
                echo $e->getMessage();f
                die();
        }
    } else {
        // echo "are you there?";
         echo "failed.";
            die();
    }

