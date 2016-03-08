<?php

    require_once '../../includes/database.php';
     
    if ( !empty($_GET['id']) && isset($_GET['id'])) {
        $id = $_GET['id'];
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM shipment_center  WHERE id = ?";
        $q = $pdo->prepare($sql);
        //$flag = $q->execute(array($id));


        try { 
            $q->execute(array($id));
            Database::disconnect();
            header("Location: index.php?error=2"); 
        } catch (PDOException $e) { 
            Database::disconnect();
            header("Location: index.php?error=1");
            //if ($e->getCode() == '23000') 
            //    echo "Syntax Error: ".$e->getMessage(); 
            //die();
        }

    } else {
        header("Location: index.php?error=3");
    }