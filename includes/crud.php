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
		$sql = "SELECT * FROM transaction WHERE customer_id = ? AND cart = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($this->customer_id,1));
		$cart = $q->fetch(PDO::FETCH_ASSOC);
		$this->cart_id = $cart['id'];
		Database::disconnect();
		

	}

	public function fetchCart() {

		$items = array();

		$pdo = Database::connect();
		$sql = "SELECT * FROM transaction_item WHERE transaction_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($this->cart_id));
		$product_ids = $q->fetchAll(PDO::FETCH_ASSOC);

		foreach ($product_ids as $pid => $row) {

			$sql = "SELECT * FROM product WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($row['product_id']));
			$product = $q->fetch(PDO::FETCH_ASSOC);
			
			array_push($items, array("transaction_item_id"=>$row['id'],"product_id"=>$row['product_id'],"quantity"=>$row['quantity'],"name"=>$product['name'],"cost"=>$product['cost'],"description"=>$product['description']));
			
		}
		Database::disconnect();
		return $items;
	}

	public function createCart() {

		try {
			$pdo = Database::connect();
			$sql = "INSERT INTO `transaction`(`customer_id`, `cart`) VALUES (?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($this->customer_id,1));
			$_SESSION['cart_id'] = $pdo->lastInsertId(); // make sure session is started
			Database::disconnect();
		} catch(PDOException $error){
			echo $error->getMessage();
			die();
		}
	}

	public function updateQuantity($tid,$new_q) {

		$pdo = Database::connect();
		$sql = "UPDATE transaction_item SET quantity = ? WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($new_q,$tid));

	}

	public function addToCart($product_id) {

		$pdo = Database::connect();
		$sql = "INSERT INTO `transaction_item` (`product_id`,`quantity`,`transaction_id`) VALUES (?,?,?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($product_id,1,$this->cart_id));
		Database::disconnect();

	}

	public function deleteItem($product_id) {

		$pdo = Database::connect();
		$sql = "DELETE FROM transaction_item WHERE product_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($product_id));
		Database::disconnect();

	}

	public function cartCheckout() {

		$pdo = Database::connect();
		$sql = "UPDATE transaction_item SET cart = ? WHERE id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array(0,$this->cart_id));
		Database::disconnect();
		$this->createCart();

	}

	public function fetchPayment() {

		$payments = array();

		$pdo = Database::connect();
		$sql =  "SELECT * FROM customer_payment WHERE customer_id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($this->customer_id));
		$payment_ids = $q->fetchAll(PDO::FETCH_ASSOC);

		foreach ($payment_ids as $payid => $row ) {

			$sql2 = "SELECT * FROM payment WHERE id = ?";
			$q2 = $pdo->prepare($sql);
			$q2->execute(array($row['payment_id']));
			$payment = $q2->fetch(PDO::FETCH_ASSOC);

			$credit_card = array("id"=>$payment['id'],"card_full_name"=>$payment['card_full_name'],"card_number"=>$payment['card_number'],"card_security"=>$payment['card_security'],"expires_month"=>$payment['expires_month'],"expires_year"=>['expires_year'],"type"=>$payment['type']);
			
			array_push($payments,$credit_card);
		}
		Database::disconnect();
		return $payments;

	}


}

// CHECKOUT CRUD ------------------------------------------------------------------------>



