<?php

	require_once 'includes/database.php';

	if ($_SESSION['cart'] == FALSE) {

		$_SESSION['cart'] == TRUE;
	}

	if ( !empty($_POST)) {

		$pid = $_POST['pid'];
		$name = $_POST['name'];
		$cost = $_POST['cost'];

		
	}





?>