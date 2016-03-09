<?php
    echo "ok";
    
    require_once '../../includes/database.php';

    if (!empty($_POST)) {
        echo "i made it.";
    }
    
        // keep track post values
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $street_1 = $_POST['street_1'];
        $street_2 = $_POST['street_2'];
        $id = $_POST['id'];
         
        //echo "fields:";
        echo  " " . $city . $state . $zip . $street_1 . $street_2 . $id;
        //die();
        /*
        // validate input
        $valid = true;

        if (empty($city)) {
            $valid = false;
        }
         
        if (empty($state)) {
            $valid = false;
        } 
         
        if (empty($zip)) {
            $valid = false;
        }
        if (empty($street_1)) {
            $valid = false;
        } 
         if (empty($street_2)) {
            $valid = false;
        } 
    }
    echo "jc";
        

        // update data
        if ($valid) {
            
            try {
            // echo "in the connect";
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE address  set city = ?, state = ?, zip = ?, street_1 = ?, street_2 = ?  WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($city,$state,$zip,$street_1,$street_2,$id));

            Database::disconnect();
            header("Location: ../../customer.php");

            }
            catch (PDOException $e){
                Database::disconnect();
                echo $e->getMessage();
                die();
        }
    } else {
        // echo "are you there?";
        echo "failed.";
        die();
    }
    */