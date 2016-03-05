<?php
   
    require_once '../../includes/database.php';
 
     
    if ( !empty($_POST)) {
        // keep track validation errorss
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
        $id = $_POST['id'];
         
        // validate input
        $valid = true;
        if (empty($card_full_name)) {
            $card_full_nameError = 'Please enter Full Name';
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
         
        // update data
        if ($valid) {
            // echo "in the connect";
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE payment  set card_full_name = ?, card_number = ?, card_security = ?, expires_month = ?, expires_year = ?, type = ?  WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($card_full_name,$card_number,$card_security,$expires_month,$expires_year,$type,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        // echo "are you there?";
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM payment where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $card_full_name = $data['card_full_name'];
        $card_number = $data['card_number'];
        $card_security = $data['card_security'];
        $expires_month = $data['expires_month'];
        $expires_year = $data['expires_year'];
        $type = $data['type'];
        Database::disconnect();
    }
?>






