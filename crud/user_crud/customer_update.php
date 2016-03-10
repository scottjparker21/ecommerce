<?php
    require_once '../../includes/database.php';
    require_once '../../includes/crud.php';
    
    session_start(); 
     
    if ( !empty($_POST)) {
 
        $first = $_POST['first'];
        $last = $_POST['last'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];
        $permission = $_POST['permission'];
        $email = $_POST['email'];
         
        $customer = new userCustomer($_SESSION['userid']);
        $response = $customer->update($first,$last,$phone,$dob,$username,$password,$gender,$email);
               echo "after function";
            die();
        header("Location: ../../customer.php");
    } else {
        echo "failed.";
        die();
    }

?>