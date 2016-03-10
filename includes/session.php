<?php
	require_once 'includes/database.php';
	session_start();

	<?php
​
// helper function for validation
function valid($varname){
	return ( !empty($varname) && isset($varname) );
}
​
​
// class Database {
// ​
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
​

public class customerAddress {	
​
​
	public $customer_id = NULL;
​
	public function __construct($customer_id){
		$this->customer_id = $customer_id;
	}
​
	public function create($city, $state, $zip, $street_1, $street_2){
		if (!valid($city) || !valid($state) || !valid($zip) || !valid($street_1) || !valid($street_2)) {
			return false;
		} else {
​
			$pdo = Database::connect();
			$sql = "INSERT INTO address (city,state,zip,street_1,street_2) values(?, ?, ?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($city,$state,$zip,$street_1,$street_2));
			$address_id = $pdo->lastInsertId();
​
			$sql = "INSERT INTO customer_address (address_id, customer_id) values(?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($address_id, $this->customer_id)); 
​
			Database::disconnect();
			return true;
		}
	}
​
	public function read(){
		try{
			$pdo = Database::connect();
			$sql = 'SELECT * FROM address WHERE id IN (SELECT address_fk FROM customer_address WHERE customer_fk = ?) ORDER BY id DESC';
			$q = $pdo->prepare($sql);
			$q->execute(array($this->customer_id));
			$data = $q->fetchAll(PDO::FETCH_ASSOC);
	        Database::disconnect();
	        return $data;
		} catch (PDOException $error){
​
			header( "Location: 500.php" );
			//echo $error->getMessage();
			die();
​
		}
​
    }
​
	public function update($city, $state, $zip, $street_1, $street_2){
		if (!valid($city) || !valid($state) || !valid($zip) || !valid($street_1) || !valid($street_2)) {
			return false;
		} else {
			$pdo = Database::connect();
			$sql = "UPDATE address SET city = ?, state = ?, zip = ?, street_1 = ?, street_2 = ? WHERE id = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($city,$state,$zip,$street_1,$street_2));
			Database::disconnect();
			return true;
		}
	}
​
	public function delete($address_id){
​
        $pdo = Database::connect();
        $sql = "DELETE FROM customer_address WHERE address_fk = ?"; //taken from SQL query on phpMyAdmin
        $q = $pdo->prepare($sql);
        $q->execute(array($address_id));
        Database::disconnect();
        return true;
​
	}
​
}
​
​
​
​
// Use Case:
// 	session_start();
// 	$myAddresses = new customerAddress($_SESSION['customer_id']);
// ​
// 	foreach ($myAddresses->read() as $row) {
// 		echo '<tr>';
// 		echo '<td>' . $row["city"] . '</td>';
// 		// and so on... 
// 		echo '</tr>';
// 	}
