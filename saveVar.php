<?php
function geocode($address){
  $address = urlencode($address);

  $url = "http://maps.google.com/maps/api/geocode/json?address={$address}&language=zh-TW";

  $response_json = file_get_contents($url);

  $response = json_decode($response_json, true);

  if($response['status']='OK'){
    $latitude_data = $response['results'][0]['geometry']['location']['lat'];
    $longitude_data = $response['results'][0]['geometry']['location']['lng'];

    if($latitude_data && $longitude_data){

      $data_array = array();

      array_push(
      $data_array,
      $latitude_data, //$data_array[0]
      $longitude_data//$data_array[1]
      );

      return $data_array;

    }else{
      return false;
    }

  }else{
    return false;
  }
}

$var=$_REQUEST["geoloc"];
$a=geocode($var);
if($a===false){
  echo "false";
}else{
  echo "[\"" . $a[0] . "\",\"" . $a[1] . "\"]" ;
}
?>