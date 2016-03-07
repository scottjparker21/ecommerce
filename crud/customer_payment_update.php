<?php
    require_once '../../database.php';
    ini_set('display_errors', 'On');
    error_reporting(E_ALL);
    
    if ( !empty($_POST)) {
        // keep track validation errors
        $card_full_nameError = null;
        $card_numberError = null;
        $card_securityError = null;
        $expires_monthError = null;
        $expires_yearError = null;
        $typeError = null;
         
        // keep track post values
        $card_full_name = $_POST['card_full_name'];
        $card_number = $_POST['card_number'];
        $card_security = $_POST['card_security'];
        $expires_month = $_POST['expires_month'];
        $expires_year = $_POST['expires_year'];
        $type = $_POST['type'];
        // validate input
        $valid = true;

        if (empty($card_full_name)) {
            $nameError = 'Please enter Full Name';
            $valid = false;
        }
        if (empty($card_number)) {
            $card_numberError = 'Please enter Card Number';
            $valid = false;
        }
        if (empty($card_security)) {
            $card_securityError = 'Please enter Card Security Number';
            $valid = false;
        }

        if (empty($expires_month)) {
            $expires_monthError = 'Please enter Expiration Month';
            $valid = false;
        }

        if (empty($expires_year)) {
            $expires_yearError = 'Please enter Expiration Year';
            $valid = false;
        }

        if (empty($type)) {
            $typeError = 'Please enter Card Type';
            $valid = false;
        }

         $uid = $_POST["userid"];
         
        // insert data
        
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "INSERT INTO payment (card_full_name,card_number,card_security,expires_month,expires_year,type) values(?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($card_full_name,$card_number,$card_security,$expires_month,$expires_year,$type));

            $last_id = $pdo->lastInsertId();

            $sql2 = "INSERT INTO customer_payment (customer_id,payment_id) values (?, ?)";
            $q2 = $pdo->prepare($sql2);
            $q2->execute(array($uid,$last_id));

            Database::disconnect();
            header("Location: index.php");
        
    }
