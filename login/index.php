<!--login-->
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
        <title>Hospital Finder-Login</title>
	</head>
	<body>
    	<div class="jumbotron">
    		<h1>LOGIN</h1>
    	</div>

    	<?php
    		$loginFailed=false;
    		$db=new Database();
    		if(isset($_POST["loginusername"])){
    			if(hash("sha256", $_POST["loginpassword"])==$db->getPassword($_POST["loginusername"])){
    				$_SESSION["user"]=serialize(new User($_POST["loginusername"]));
    				header("Location: ../" . (isset($_SESSION["redir"])?$_SESSION["redir"]:""));
    			}else{
    				$loginFailed=true;
    			}
    		}
        ?>

        <div class="container">
        	<form method="POST" role="form" action="">
        		<div class="form-group">
	        		<label for="username">Username</label>
	        		<input type="text" class="form-control" id="username" name="loginusername" placeholder="Username" value="<?php if(isset($_POST["loginusername"])){echo $_POST["loginusername"];} ?>" required>
	        	</div>
	        	<div class="form-group <?php echo ($loginFailed)?"has-error":""; ?>">
	        		<label for="password">Password</label>
	        		<input type="password" class="form-control" id="password" name="loginpassword" placeholder="Password" required>
	        		<?php if($loginFailed){echo "<small class=\"text-danger\">Invalid password and username combination</small>";}?>
	        	</div>
	        	<div class="form-group">
				    <button type="submit" class="btn btn-default">Submit</button>
			 	</div>
        	</form>
        	<a href="../"><p>home</p></a>
        </div>
	</body>
</html>