<?php

	require_once 'includes/session.php'; 
	require_once 'includes/crud.php';

	$cart_checkout = new cart();
	$cart_checkout->cartCheckout();

	header("Location: index.php");