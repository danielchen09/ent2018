<?php
     // Get lat and long by address    
    ini_set('display_errors', 1);
    ini_set('displat_startup_errors', 1);
    error_reporting(E_ALL);
    include("classes.php");
    
    $db=new Database();

    for($i=1; $i<=30; $i++){
        $db->setGeocode($i);
        sleep(1);
    }
?>