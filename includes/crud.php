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



// Customer Address Crud ------------------------------------------------------------------------->


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
			$sql = "INSERT INTO address (city,state,zip,street_1,street_2) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($city,$state,$zip,$street_one,$street_two));
			$address_id = $pdo->lastInsertId();

			$sql = "INSERT INTO customer_address (customer_id,address_id) values(?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($this->customer_id, $address_id)); 

			Database::disconnect();
			return true;
		}
	}

	public function read(){
		try{
			$pdo = Database::connect();
			$sql = "SELECT `address`.* FROM `address` LEFT JOIN `customer_address` ON `address`.`id` = `customer_address`.`address_id` WHERE `customer_address`.`customer_id` = ?";
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

	public function update($city, $state, $zip, $street_one, $street_two, $id){
		if (!valid($city) || !valid($state) || !valid($zip) || !valid($street_one) || !valid($street_two) || !valid($id)) {
			return false;
		} else {

			$pdo = Database::connect();
			$sql = "UPDATE address SET city = ?, state = ?,zip = ?, street_1 = ?, street_2 = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($city,$state,$zip,$street_one,$street_two,$id));
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

// Customer Payment Crud ------------------------------------------------------------------------->

class customerPayment {	


	public $customer_id;

	public function __construct($customer_id){
		$this->customer_id = $customer_id;
	}

	public function create($card_full_name, $card_number, $card_security, $expires_month, $expires_year, $type){
		if (!valid($card_full_name) || !valid($card_number) || !valid($card_security) || !valid($expires_month) || !valid($expires_year) || !valid($type)) {
			return false;
		} else {

			$pdo = Database::connect();
           
                $sql = "INSERT INTO payment (card_full_name,card_number,card_security,expires_month,expires_year,type) values(?, ?, ?, ?, ?, ?)";
                $q = $pdo->prepare($sql);

                $q->execute(array($card_full_name,$card_number,$card_security,$expires_month,$expires_year,$type));

                $last_id = $pdo->lastInsertId();

                $sql2 = "INSERT INTO customer_payment (customer_id,payment_id) values (?, ?)";
                $q2 = $pdo->prepare($sql2);
                $q2->execute(array($this->customer_id,$last_id));

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

	public function update($card_full_name, $card_number, $card_security, $expires_month, $expires_year, $type, $id){
		if (!valid($card_full_name) || !valid($card_number) || !valid($card_security) || !valid($expires_month) || !valid($expires_year) || !valid($type) || !valid($id)) {
			return false;
		} else {

			$pdo = Database::connect();
			$sql = "UPDATE payment SET card_full_name = ?, card_number = ?, card_security = ?, expires_month = ?, expires_year = ?, type = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($card_full_name,$card_number,$card_security,$expires_month,$expires_year,$type,$id));
			Database::disconnect();
			return true;
		}
	}

	public function delete($payment_id){

        $pdo = Database::connect();
        $sql = "DELETE FROM customer_payment WHERE payment_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($payment_id));
        Database::disconnect();
        return true;

	}

}


// User Customer Crud ------------------------------------------------------------------------->


class userCustomer {	


	public $customer_id;

	public function __construct($customer_id){
		$this->customer_id = $customer_id;
	}

	public function create($card_full_name, $card_number, $card_security, $expires_month, $expires_year, $type){
		if (!valid($card_full_name) || !valid($card_number) || !valid($card_security) || !valid($expires_month) || !valid($expires_year) || !valid($type)) {
			return false;
		} else {

			$pdo = Database::connect();
           
                $sql = "INSERT INTO payment (card_full_name,card_number,card_security,expires_month,expires_year,type) values(?, ?, ?, ?, ?, ?)";
                $q = $pdo->prepare($sql);

                $q->execute(array($card_full_name,$card_number,$card_security,$expires_month,$expires_year,$type));

                $last_id = $pdo->lastInsertId();

                $sql2 = "INSERT INTO customer_payment (customer_id,payment_id) values (?, ?)";
                $q2 = $pdo->prepare($sql2);
                $q2->execute(array($this->customer_id,$last_id));

                Database::disconnect();
				return true;
		}
	}

	public function read(){
		try{
			$pdo = Database::connect();
			$sql = "SELECT * FROM customer WHERE id = ?";;
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

	public function update($card_full_name, $card_number, $card_security, $expires_month, $expires_year, $type, $id){
		if (!valid($card_full_name) || !valid($card_number) || !valid($card_security) || !valid($expires_month) || !valid($expires_year) || !valid($type) || !valid($id)) {
			return false;
		} else {

			$pdo = Database::connect();
			$sql = "UPDATE payment SET card_full_name = ?, card_number = ?, card_security = ?, expires_month = ?, expires_year = ?, type = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($card_full_name,$card_number,$card_security,$expires_month,$expires_year,$type,$id));
			Database::disconnect();
			return true;
		}
	}

	public function delete($payment_id){

        $pdo = Database::connect();
        $sql = "DELETE FROM customer_payment WHERE payment_id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($payment_id));
        Database::disconnect();
        return true;

	}

}







