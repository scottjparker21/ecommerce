<?php
	
	session_start();

	 if( isset( $_SESSION['userid'] ) )
	   {
	      echo "you are logged in" ;
	   }
	 else
	   {
	   	  echo "create account to login";
	   }

?>