<?php
   
    require_once '../../includes/database.php';
    require_once '../../includes/crud.php';
 
     
    if ( !empty($_POST)) {

        $card_full_name = $_POST['card_full_name'];
        $card_number = $_POST['card_number'];
        $card_security = $_POST['card_security'];
        $expires_month = $_POST['expires_month'];
        $expires_year = $_POST['expires_year'];
        $type = $_POST['type'];
        $id = $_POST['id'];

        $payment = new customerPayment($_SESSION['userid']);
        $response = $payment->update($card_full_name, $card_number, $card_security, $expires_month, $expires_year,$type, $id);
        header("Location: ../../customer.php");

    }   else {
            echo "failed.";
            die();
    }
?>