<?php

	require_once 'includes/session.php'; 
	require_once 'includes/crud.php'; 
	
		$pid = $_POST['id'];
		$tid = $_POST['transaction_item_id'];

		echo $pid . " ";
		echo $tid . " ";
		die();

