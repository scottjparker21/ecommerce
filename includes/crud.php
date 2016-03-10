<?php

session_start();
// helper function for validation
function valid($varname){
	return ( !empty($varname) && isset($varname) );
}


// class Database {

// 	private static $dbName = 'ecom' ; 
// 	private static $dbHost = 'localhost' ;
// 	private static $dbUsername = 'root';
// 	private static $dbUserPassword = 'password';
// 	private static $cont  = null;
	
// 	public function __construct() {
// 		exit('Init function is not allowed');
// 	}
	
// 	public static function connect()
// 	{
// 	    // One connection through whole application
//         if ( null == self::$cont ) {      
//         	try {
//           		self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
//           		self::$cont->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 			} catch(PDOException $e) {
//           		die($e->getMessage());  
//         	}
//         } 
//        	return self::$cont;
// 	}
	
// 	public static function disconnect() {
// 		self::$cont = null;
// 	}
// }






class customerAddress {	


	public $customer_id;

	public function __construct($customer_id){
		$this->customer_id = $customer_id;
	}

	public function create($city, $state, $zip, $street_one, $street_two){
		if (!valid($city) || !valid($state) || !valid($zip) || !valid($street_one) || !valid($street_two)) {
			return false;
		} else {

			$pdo = Database::connect();
			$sql = "INSERT INTO address (city,state,zip,street_one,street_two) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($city,$state,$zip,$street_one,$street_two));
			$address_id = $pdo->lastInsertId();

			$sql = "INSERT INTO customer_address (address_id, customer_id) values(?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($address_id, $this->customer_id)); 

			Database::disconnect();
			return true;
		}
	}

	public function read(){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM address WHERE id IN (SELECT address_id FROM customer_address WHERE customer_id = ?) ORDER BY id DESC';
			$q = $pdo->prepare($sql);
			$q->execute(array($this->customer_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
	        Database::disconnect();
	        return $data;
		} catch (PDOException $error){

			header( "Location: 500.php" );
			//echo $error->getMessage();
			die();

		}

    }

	public function update($city, $state, $zip, $street_one, $street_two){
		if (!valid($city) || !valid($state) || !valid($zip) || !valid($street_one) || !valid($street_two)) {
			return false;
		} else {
			
			$pdo = Database::connect();
			$sql = "UPDATE address SET city = ?, state = ?,zip = ?, street_one = ?, street_two = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($city,$state,$zip,$street_one,$street_two,$_SESSION['user_id']));
			Database::disconnect();
			return true;
		}
	}

	public function delete($address_id){

        $pdo = Database::connect();
        $sql = "DELETE FROM customer_address WHERE address_id = ?"; //taken from SQL query on phpMyAdmin
        $q = $pdo->prepare($sql);
        $q->execute(array($address_id));
        Database::disconnect();
        return true;

	}

}













