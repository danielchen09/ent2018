<!--home-->
<?php
ini_set('display_errors', 1);
ini_set('displat_startup_errors', 1);
error_reporting(E_ALL);
include("classes.php");
session_start();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		
    	<div class="jumbotron">
            <div class="container">
        		<h1>HOSPITAL FINDER</h1>
        		<p>this app finds hospital lol</p>
            </div>
    	</div>

    	
    	<?php

        ?>

        <a href="login"><p>login</p></a>
        <a href="register"><p>resgister</p></a>
        <a href="personalInfo"><p>personalInfo</p></a>
        <a href="profile"><p>profile</p></a>
        <a href="logout.php"><p>logout</p></a>
	</body>
</html>