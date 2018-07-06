<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Geocoding service</title>
        <meta charset="utf-8">
    </head>
    <body>
        <div id="output"></div>
        <script>
            function geocodeAddress() {
                var connection = new ActiveXObject("ADODB.Connection");
                var connectionstring = "Data Source=<localhost>;Initial Catalog=<Database>;User ID=<root>;Password=<101dc101>;Provider=SQLOLEDB";
                connection.Open(connectionstring);
                var rs = new ActiveXObject("ADODB.Recordset");
                rs.Open("SELECT address FROM HOSPITALINFO LIMIT 1", connection);
                var address = rs.fields(0);

                var geocoder = new google.maps.Geocoder();
                var geoLoc;
                var output = document.getElementById('output');
                geocoder.geocode({'address': address}, function(results, status) {
                    if (status === 'OK') {
                        geoLoc = results[0].geometry.location;
                        output.innerHTML = geoLoc;
                    }
                    else {
                        output.innerHTML = "Geocode was not successful for the following reason: " + status;
                    }
                });
            }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAa6Ly7B_jOG4p6r9uK1Aw4je5BWnoqPtY&callback=geocodeAddress"></script>
    </body>
</html>
