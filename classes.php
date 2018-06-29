<?php
class User{
	private $username;

	private $name;
	private $birthDate;
	private $gender;
	private $phone;

	function __construct($username){
		$this->username = $username;
		
		$db = new Database();	
		$userInfo = $db->getUserInfo($this->username);

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
	function getGender(){
		return $this->gender;
	}
	function getPhone(){
		return $this->phone;
	}

	function update(){
		$db = new Database();	
		$userInfo = $db->getUserInfo($this->username);

		$this->name = $userInfo["name"];
		$this->phone = $userInfo["phone"];
		$this->birthDate = $userInfo["birthDate"];
		$this->gender = $userInfo["gender"];

		$db->__destruct();
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
	function updateUser($user, $name, $birthDate, $gender, $phone){
		$this->conn->query("UPDATE USERS SET name='" . $name . "', birthDate='" . $birthDate . "', gender='" . $gender . "', phone='" . $phone . "' WHERE username='" . $user->getUsername() . "';");
	}
	function userExists($username){
		return $this->conn->query("SELECT username FROM USERS WHERE username='" . $username . "';")->fetch_assoc() != null;
	}

	//login
	function getUserInfo($username){
		return $this->conn->query("SELECT name, birthDate, gender, phone FROM USERS WHERE username='" . $username . "';")->fetch_assoc();
	}
	function getPassword($username){
		return $this->conn->query("SELECT password FROM USERS WHERE username='" . $username . "';")->fetch_assoc()["password"];
	}

	//other
	function getRows($table){
		return $this->conn->query("SELECT * FROM " . $table . ";")->num_rows;
	}
}

class HospitalData{
	private $html;

	function __construct($url){
		$ch = curl_init(); 
		//ddl_City 
		//$data=array("ddl_City"=>"01");  
		$data="";
		curl_setopt($ch, CURLOPT_URL, $url);  
		curl_setopt($ch, CURLOPT_HEADER, 0); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
		curl_setopt($ch, CURLOPT_POST, 1); 
		//curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("application/x-www-form-urlencoded; charset=utf-8", 
		    "Content-length: ".strlen($data)
		    )); 
		$this->html = curl_exec($ch);   
		if(curl_errno($ch)){
		    echo 'Curl error: ' . curl_error($ch);
		}
		curl_close($ch);
	}

	function matchPattern($pattern){
		preg_match_all($pattern, $this->html, $matches);
		return $matches;
	}

	function getRows(){
		preg_match_all("~<tr[^>]*>(.*)</tr>~U", $this->html, $matches);
		return $matches;
	}

	function getHtml(){
		return $this->html;
	}

}
?>