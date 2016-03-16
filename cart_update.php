<?php

	require_once 'includes/session.php'; 
	require_once 'includes/crud.php'; 
	
		$tid = $_POST['transaction_item_id'];
		$new_q = $_POST['quantity'];

		echo $new_q;
		die();

		$q_update = new cart();
		$q_update->updateQuantity($tid);


