<?php
class User{
	private $username;

	private $name;
	private $birthDate;
	private $phone;

	function __construct($username){
		$this->username = $username;
		
		$db = new Database();	
		$userInfo = $db->getUserInfo($this->username);

		$this->name = $userInfo["name"];
		$this->phone = $userInfo["phone"];
		$this->birthDate = strtotime($userInfo["birthDate"]);

		$db->__destruct();
	}

	//logged in
	function getName(){
		return $this->name;
	}
	function getUsername(){
		return $this->username;
	}
	function getBirthDate(){
		return $this->birthDate;
	}
	function getPhone(){
		return $this->phone;
	}
}

class Database{
	private $conn;
	private $host = "localhost";
	private $username = "root";
	private $password = "101dc101";
	private $name = "hospitalApp";

	function __construct(){
		$this->conn = new mysqli($this->host, $this->username, $this->password, $this->name);
		$this->conn->set_charset("utf8");
		if($this->conn->connect_error){
			die("Database connection failed: " . $this->conn->connect_error);
		}
	}

	function __destruct(){
		unset($this->conn);
		unset($this->host);
		unset($this->username);
		unset($this->password);
		unset($this->name);
	}

	//database
	function getConn(){
		return $this->conn;
	}

	//register
	function addUser($username, $password){
		$this->conn->query("INSERT INTO USERS(username, password) VALUES('" . $username . "', '" . $password . "');");
	}
	function updateUser($username, $name, $birthDate, $phone){
		$this->conn->query("UPDATE USERS SET name='" . $name . "', '" . $birthDate . "', '" . $phone . "' WHERE username='" . $username . "';");
	}
	function userExists($username){
		return $this->conn->query("SELECT username FROM USERS WHERE username='" . $username . "';")->fetch_assoc() != null;
	}

	//login
	function getUserInfo($username){
		return $this->conn->query("SELECT name, birthDate, phone FROM USERS WHERE username='" . $username . "';")->fetch_assoc();
	}
	function getPassword($username){
		return $this->conn->query("SELECT password FROM USERS WHERE username='" . $username . "';")->fetch_assoc()["password"];
	}

	//other
	function getRows($table){
		return $this->conn->query("SELECT * FROM " . $table . ";")->num_rows;
	}
}
?>
