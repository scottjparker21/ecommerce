<?php
    
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    // echo "im here";
    require_once '../../database.php';

   $id = $_POST['id'];
   
    if (!empty($_POST['id']) && isset($_POST['id'])) {
        // keep track validation errorss
        $nameError = null;
        $costError = null;
        $descriptionError = null;
        $subidError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $cost = $_POST['cost'];
        $description = $_POST['description'];
        $subid = $_POST['subcategory_id'];
        
        // validate input
        $valid = true;

        if (!empty($_POST['name']) && isset($_POST['name'])) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (!empty($_POST['cost']) && isset($_POST['cost'])) {
            $costError = 'Please enter product cost';
            $valid = false;
        } 
         
        if (!empty($_POST['description']) && isset($_POST['description'])) {
            $descriptionError = 'Please enter Description';
            $valid = false;
        }
        if (!empty($_POST['subid']) && isset($_POST['subid'])) {
            $subidError = 'Please enter Subcategory ID';
            $valid = false;
        }
        
        // update data
            try {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE product  set name = ?, cost = ?, description = ?, subcategory_id = ?  WHERE id = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($name,$cost,$description,$subid,$id));
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

