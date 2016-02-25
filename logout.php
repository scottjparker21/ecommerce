<?php
	
	session_start();

	echo "You have successfully logged out";

	header("Location: index.php");

	session_destroy();

?>