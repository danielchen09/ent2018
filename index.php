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
            <?php
                if(!isset($_SESSION["user"])){
                echo "
                    <ul>
                        <li><a data = \"LOGIN\" href = \"./login\"><i class = \"fa fa-sign-in\"></i> LOGIN</a></li>
                        <li class = \"verticalBar\"><p> | </p></li>
                        <li><a data = \"REGISTER\" href = \"./register\"><i class = \"fa fa-user-plus\"></i> REGISTER</a></li>
                    </ul>
                ";
                }else{
                echo "
                    <div id = \"nav\" class = \"menu\">
                        <a onclick = \"openNav()\"><i class = \"fa fa-user-circle-o\"></i></a>
                    </div>
                    <div id = \"sideNav\" class = \"sideNavBar\">
                        <div class = \"icon\">
                            <a data = \"CLOSE\" href = \"javascript:void(0)\" onclick = \"closeNav()\"><i class = \"fa fa-remove\"></i></a>
                            <a data = \"REGISTER\" href = \"./register/index.php\"><i class = \"fa fa-user-plus\"></i></a>
                            <a data = \"UPDATE\" href = \"./personalInfo/index.php\"><i class = \"fa fa-pencil-square-o\"></i></a>
                            <a data = \"PROFILE\" href = \"./profile/index.php\"><i class = \"fa fa-drivers-license-o\"></i></a>
                            <a data = \"LOGOUT\" href = \"logout.php\"><i class = \"fa fa-sign-out\"></i></a>
                        </div>
                    </div>
                ";
                }
            ?>
            <h1>HOSPITAL FINDER</h1>
        </div>
        <h1></h1>
        <br><br>
        
        <script>
            function openNav(){
                document.getElementById("sideNav").style.width = "10%";
                document.getElementById("nav").style.display = "none";
            }

            function closeNav(){
                document.getElementById("sideNav").style.width = "0";
                document.getElementById("nav").style.display = "block";
            }

            $('body').click( function (e) { 
                if ( e.target.nodeName != "I") 
                    closeNav();
            });
        </script>

        <div class="container">
            <a href=""><img src="clinicLocation.png" class="image"></a>
            <br>
            <a href=""><img src="emergencyLocation.png" class="image"></a>
            <br>
            <a href=""><img src="hospitalLocation.png" class="image"></a>
            <br>
        </div>
	</body>

</html>