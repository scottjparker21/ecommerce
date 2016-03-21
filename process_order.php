<?php

	require_once 'includes/session.php'; 
	require_once 'includes/crud.php';

	$cart_checkout = new cart();
	$cart_checkout->cartCheckout();

 
if(isset($_POST)) {
 
      
    $email_to = $_POST['useremail'];
 
    $email_subject = "Testing";
 
    $email_message = "Thankyou for shopping with us. Your order is being processed.";
 	$headers = 'customer@checkout.com';    

 
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>
 
 
 
<!-- include your own success html here -->
 
 
 
Thank you for contacting us. We will be in touch with you very soon.
 
 
 
<?php
 
}
 
?>

	header("Location: index.php");