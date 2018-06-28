<!--home-->
<?php
ini_set('display_errors', 1);
ini_set('displat_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("classes.php");
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
        <h1>HOSPITAL FINDER</h1>
        <a href="findNearest.php"><img src="marker.png" class="image"></a>


	</body>
</html>