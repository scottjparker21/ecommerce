<?php
	
	require_once 'includes/session.php'; 
	require_once 'includes/crud.php';

	$pid = $_POST['product_id'];

	echo $pid;
	die();

	$delete_item = new cart();
	$delete_item->deleteItem($pid);

	header( "Location: cart.php" );