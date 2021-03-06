<!--profile-->
<?php
ini_set('display_errors', 1);
ini_set('displat_startup_errors', 1);
error_reporting(E_ALL);
include("../classes.php");
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
	  	<link rel="shortcut icon" type="image/x-icon" href="../marker.png" />
        <title>Hospital Finder-<?php if(isset($_SESSION["user"])) echo "@" . unserialize($_SESSION["user"])->getUsername();?></title>
	</head>
	<body>
		<?php
			if(!isset($_SESSION["user"])){
				$_SESSION["redir"]="profile";
				header("Location: ../login/");
			}
			$user = unserialize($_SESSION["user"]);
			$user->update();
		?>
    	<div class="jumbotron">
    		<h1>PROFILE</h1>
    	</div>

      	<div class="container">
      		<div class="well">
	      		Name:
	      		<?php
	      			if($user->getName()!==null){
	      				echo $user->getName();
	      			}else{
	      				echo "not set";
	      			}
	      			echo "<br>@" . $user->getUsername();
	      		?>
      		</div>
      		<div class="well">
	      		Birthday:
	      		<?php
	      			if($user->getBirthDate()!==null){
	      				echo $user->getBirthDate();
	      			}else{
	      				echo "not set";
	      			}
	      		?>
      		</div>
      		<div class="well">
      			Gender:
      			<?php
      				if($user->getGender()!=="N"){
      					switch($user->getGender()){
      						case "O":
      							echo "Other";
      							break;
      						case "M":
      							echo "Male";
      							break;
      						case "F":
      							echo "Female";
      							break;
      						default:
      							echo "not set";
      					}
      				}else{
      					echo "not set";
      				}
      			?>
      		</div>
      		<div class="well">
      			Phone number:
      			<?php
	      			if($user->getPhone()!==null){
	      				echo $user->getPhone();
	      			}else{
	      				echo "not set";
	      			}
      			?>
      		</div>
        	<a href="../"><p>home</p></a>
      	</div>
	</body>
</html>