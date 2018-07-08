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
    private $username = "winnieli";
    private $password = "winnieli1129";
    private $name = "hospitalocateDb";

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

    //medHistory
    function addMedHistory($user, $name, $status, $startYr){
        $this->conn->query("INSERT INTO MEDHISTORY(username, name, status, startYr) VALUES('" . $user->getUsername() . "', '" . $name . "', '" . $status . "', '" . $startYr . "');");
    }
    function getMedHistory($user){
        $result = $this->conn->query("SELECT name, status, startYr FROM MEDHISTORY WHERE username='" . $user->getUsername() . "';");
        $results=array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $results[]=$row;
            }
        }
        return $results;
    }

    //medicine
    function addMedicine($user, $name, $purpose, $frequency, $period, $ongoing){
        $this->conn->query("INSERT INTO MEDICINE(username, name, purpose, frequency, period, ongoing) VALUES('" . $user->getUsername() . "', '" . $name . "', '" . $purpose . "', '" . $frequency . "', '" . $period . "', '" . $ongoing . "');");
    }
    function getMedicine($user){
        $result = $this->conn->query("SELECT name, purpose, frequency, period, ongoing FROM MEDICINE WHERE username='" . $user->getUsername() . "';");
        $results=array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $results[]=$row;
            }
        }
        return $results;
    }

    //find
    function getAddress(){
        $result = $this->conn->query("SELECT address FROM HOSPITALINFO LIMIT 50");
        $results=array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $results[]=$row;
            }
        }
        return $results;
    }
    function getAddressByName($name){
        $result = $this->conn->query("SELECT address FROM HOSPITALINFO WHERE name LIKE '%" . $name . "%';");
        echo $name;
        $results=array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $results[]=$row;
            }
        }
        return $results;
    }
    function setGeocode($id){
        $address = ($this->conn->query("SELECT address FROM HOSPITALINFO WHERE ID='" . $id . "';")->fetch_assoc())["address"];

        $prepAddr = str_replace(' ','+',$address);
        $geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?key=AIzaSyAa6Ly7B_jOG4p6r9uK1Aw4je5BWnoqPtY&address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;

        if($output->status=='OK'){
            $this->conn->query("UPDATE HOSPITALINFO SET latitude='" . $latitude . "', longitude='" . $longitude . "' WHERE ID='" . $id . "';");
        }else{
            echo $id . ":" . $output->status;
        }
    }

    //general
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

class HospitalDataTW{
    private $name;
    private $admission;
    private $other;
    private $full;
    private $status;
    private $address;

    function __construct(){
        $h=new HospitalData("https://www.nhi.gov.tw/SysService/SevereAcuteHospital.aspx");
        $html=$h->getHtml();
        preg_match_all("~<a[^>]*>(.*)</a>~U", $html, $this->name);
        preg_match_all("~([0-9]+)</div>~isU", $html, $this->admission);
        preg_match_all("~\s(是|否)~isU", $html, $this->full);
        preg_match_all("~([0-9]+)</td>~isU", $html, $others1);
        preg_match_all("~IP_[A-Z]~isU", $html, $this->status);
        $this->other=array(array());
        for($i=0; $i<count($others1[0])/3; $i++){
            $this->other[$i]=array($others1[0][3*$i], $others1[0][3*$i+1], $others1[0][3*$i+2]);
        }
        $db=new Database();
        $this->address=array();
        for($i = 0; $i < count($this->name[0]); $i++){
            $index = strpos($this->name[0][$i], ">") + 1;
            $n = substr($this->name[0][$i],$index, -4);
            $this->name[0][$i] = $n;
        }
        for($i=0; $i<count($this->name[0]); $i++){
            $this->address[$i]=($db->getAddressByName($this->name[0][$i]))[0]["address"];
        }
    }

    function getName(){
        return $this->name;
    }
    function getAddress(){
        return $this->address;
    }
    function getAdmission(){
        return $this->admission;
    }
    function getOther(){
        return $this->other;
    }
    function getFull(){
        return $this->full;
    }
    function getStatus(){
        return $this->status;
    }
}
?>
