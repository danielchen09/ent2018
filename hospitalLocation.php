<?php
  $data_array = geocode($set_address);
  $latitude = $data_array[0];
  $longitude = $data_array[1];
  $data_address = $data_array[2];

  function geocode($address){
      $address = urlencode($address);

      $url = "http://maps.google.com/maps/api/geocode/json?address={$address}&language=zh-TW";

      $response_json = file_get_contents($url);

      $response = json_decode($response_json, true);

      if($response['status']='OK'){
          $latitude_data = $response['results'][0]['geometry']['location']['lat']; //緯度
          $longitude_data = $response['results'][0]['geometry']['location']['lng']; //精度
          $data_address = $response['results'][0]['formatted_address'];

          if($latitude_data && $longitude_data && $data_address){

              $data_array = array();            
              
              array_push(
                  $data_array,
                  $latitude_data, //$data_array[0]
                  $longitude_data, //$data_array[1]
              );

              return $data_array; //回傳$data_array

          }else{
              return false;
          }

      }else{
          return false;
      }
  }
  //-----function end-----
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Find Hospital</title>
    <link rel = "stylesheet" href = "map.css">
  </head>
  <body>
    <div id="right-panel">
      <div id="inputs">
      </div>
      <div>
        <strong>Results</strong>
      </div>
      <div id="output"></div>
    </div>
    <div id="map"></div>
    <script>

      var mysql = require("mysql");

      var con = mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "101dc101",
        database: "hospitalApp",
      });

      var desArr;

      function getLocation(){
        if(navigator.geolocation){
          navigator.geolocation.getCurrentPosition(currentPosition);
        }
      }
      function currentPosition(position){
        var loc = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        con.connect(function(err)){
          if (err) throw err;
          con.query("SELECT address FROM HOSPITALINFO", function(err, addr, fields)){
            if(err) throw err;
            desArr = addr;
          }
        }
        for(int x; x = 0; x < desArr.length; x++){
          var desGeoloc.push(<?php echo geocode(desArr[x]);?>);
          initMap(loc, desGeoloc);
      }
      function initMap(loc, desLoc) {
        var bounds = new google.maps.LatLngBounds;
        var markersArray = [];

        var destinationIcon = 'https://chart.googleapis.com/chart?' +
            'chst=d_map_pin_letter&chld=D|FF0000|000000';
        var originIcon = 'https://chart.googleapis.com/chart?' +
            'chst=d_map_pin_letter&chld=O|FFFF00|000000';
        var map = new google.maps.Map(document.getElementById('map'), {
          center: loc,
          zoom: 10
        });
        var geocoder = new google.maps.Geocoder;

        var service = new google.maps.DistanceMatrixService;
        service.getDistanceMatrix({
          origins: [loc],
          destinations: [desLoc],
          travelMode: 'DRIVING',
          unitSystem: google.maps.UnitSystem.METRIC,
          avoidHighways: false,
          avoidTolls: false
        }, function(response, status) {
          if (status !== 'OK') {
            alert('Error was: ' + status);
          } 
          else {
            var originList = response.originAddresses;
            var destinationList = response.destinationAddresses;
            var outputDiv = document.getElementById('output');
            outputDiv.innerHTML = '';
            deleteMarkers(markersArray);

            var showGeocodedAddressOnMap = function(asDestination) {
              var icon = asDestination ? destinationIcon : originIcon;
              return function(results, status) {
                if (status === 'OK') {
                  map.fitBounds(bounds.extend(results[0].geometry.location));
                  markersArray.push(new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: icon
                  }));
                } else {
                  alert('Geocode was not successful due to: ' + status);
                }
              };
            };
            var count = 0;
            var z = 0;
            for (var i = 0; i < originList.length; i++) {
      				var results = response.rows[i].elements;
      				if(count == 0){
      					count++;
      					var shortest = results[0];
                var des = destinationList[0];
      				}
      				geocoder.geocode({'address': originList[i]},
      				showGeocodedAddressOnMap(false));
      				for (var j = 0; j < results.length; j++) {
      					geocoder.geocode({'address': destinationList[j]},
      					showGeocodedAddressOnMap(true));
      					outputDiv.innerHTML += originList[i] + ' to ' + destinationList[j] +
      					': ' + results[j].distance.text + ' in ' +
      					results[j].duration.text + '<br>';
                if(z == 0){
                  z++;
                  var origin = originList[0];
                }
      					if (results[j].duration.value < shortest.duration.value){
      						shortest = results[j];
      						origin = originList[i];
      						des = destinationList[j];
  				  	  }
  				    }
            }
            outputDiv.innerHTML += "<br>" + origin + " to " + des + ": " +shortest.distance.text + " in " +shortest.duration.text + "<br>";
          }
        });
      }

      function deleteMarkers(markersArray) {
        for (var i = 0; i < markersArray.length; i++) {
          markersArray[i].setMap(null);
        }
        markersArray = [];
      }
    </script>
    <script async defer src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyAa6Ly7B_jOG4p6r9uK1Aw4je5BWnoqPtY&callback=getLocation">
    </script>
  </body>
</html>