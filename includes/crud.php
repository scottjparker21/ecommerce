<?php

session_start();

// helper function for validation
function valid($varname){
	return ( !empty($varname) && isset($varname) );
}

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

	public function update($first, $last, $phone, $dob, $username, $password, $gender, $email){
		if (!valid($first) || !valid($last) || !valid($phone) || !valid($dob) || !valid($username) || !valid($password) || !valid($gender) || !valid($email)) {
			return false;
		} else {

			$pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE customer set first = ?, last = ?, phone = ?, dob = ?, username = ?, password = ?, gender = ?, email = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($first,$last,$phone,$dob,$username,$password,$gender,$email,$this->customer_id));
            Database::disconnect();
			return true;
		}
	}

}

// CART CRUD ------------------------------------------------------------------------->


class cart {

	public $customer_id;
	public $cart_id;

	public function __construct(){

		$this->customer_id = $_SESSION['userid'];
		$pdo = Database::connect();
		$sql = "SELECT * FROM transaction WHERE customer_id = '$this->customer_id'";
		$result = $pdo->query($sql);
		$this->cart_id = $result['id'];
		Database::disconnect();

	}

	public function fetchCart() {

		$items = array();

		$pdo = Database::connect();
		$sql = "SELECT * FROM transaction_item WHERE transaction_id = ?";
		$q->execute(array($this->cart_id));
		$product_ids = $q->fetchAll(PDO::FETCH_ASSOC);

		foreach ($product_ids as $pid => $row) {
			$sql = "SELECT * FROM product WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($row['product_id']));
			$product = $q->fetchAll(PDO::FETCH_ASSOC);
			array_push($items, array("pid"=>$row['product_id'],"quantity"=>$row['quantity'],"name"=>$row['name'],"cost"=>$row['cost'],"description"=>$row['description']));
			Database::disconnect();
		}
		return $items;
	}

	public function createCart() {

		try {
			$pdo = Database::connect();
			$sql = "INSERT INTO transaction (customer_id,cart,payment_id,address_id) values(?,?,?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($this->customer_id,1,NULL,NULL));

			$_SESSION['cart_id'] = $pdo->lastInsertId();
			Database::disconnect();
		} catch(PDOException $error){
			echo $error;
			die();
		}
	}
}

// TRANSACTION CRUD ------------------------------------------------------------------------>





