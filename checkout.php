<?php

	require_once 'includes/session.php'; 
	require_once 'includes/crud.php';

	$cart_checkout = new cart();
	$cart_checkout->cartCheckout();

	$new_cart = new cart();
	$new_cart->createCart();

	header( "Location: cart.php" );