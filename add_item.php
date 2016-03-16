<?php

	require_once 'includes/session.php'; 
	require_once 'includes/crud.php';

	$pid = $_POST['id'];
	
	$add_to = new cart();
	$add_to->addToCart($pid);

	header( "Location: add_success.php" );





?>