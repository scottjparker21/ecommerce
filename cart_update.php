<?php

	require_once 'includes/session.php'; 
	require_once 'includes/crud.php'; 
	
		$tid = $_POST['transaction_item_id'];
		$new_q = $_POST['quantity'];

		$q_update = new cart();
		$q_update->updateQuantity($tid,$new_q);

		header( "Location: cart.php" );


