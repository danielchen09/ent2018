<!--home-->
<?php
ini_set('display_errors', 1);
ini_set('displat_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("classes.php");
$_SESSION["redir"]="";
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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="shortcut icon" type="image/x-icon" href="marker.png" />
        <title>Hospital Finder</title>
	</head>
	<body>
        <div class="jumbotron">
            <h1>HOSPITAL FINDER</h1>
        </div>
        <h1></h1>
        <br>
        <a href="findNearest.php"><img src="marker.png" class="image"></a>

        <br>
        <?php
        if(!isset($_SESSION["user"])){
            echo "<a href=\"login\"><p>login</p></a>
            <a href=\"register\"><p>resgister</p></a>";
        }
        ?>
        <a href="personalInfo"><p>personalInfo</p></a>
        <a href="profile"><p>profile</p></a>
        <a href="logout.php"><p>logout</p></a>
	</body>

</html>