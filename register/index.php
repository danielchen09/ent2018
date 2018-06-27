<!--register-->
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
	</head>
	<body>
    	<div class="jumbotron">
    		<h1>REGISTER</h1>
    	</div>

    	<?php
    		$db=new Database();
    		$userExists = false;
    		if(isset($_POST["username"])){
    			$userExists = $db->userExists($_POST["username"]);
    		}
    		if(!$userExists){
    			if(isset($_POST["username"])){
    			$db->addUser($_POST["username"], hash("sha256", $_POST["password"]));
    			header("Location: ../");
    			}
    		}
    	?>

        <div class="container">
	        <form data-toggle="validator" method="POST" role="form" action="">
				<div class="form-group <?php echo ($userExists)?"has-error":""; $entered=true;?>">
	    			<label for="username">Username</label>
				    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo ((isset($_POST["username"]))?$_POST["username"]:""); ?>" required>
					<?php echo ($userExists)?"<small class=\"text-danger\">The username you entered is already used</small>":""; ?>
				</div>
				<div class="form-group">
	    			<label for="password">Password</label>
				    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
				    <div class="help-block with-errors">Minimum of 6 characters</div>
				</div>
				<div class="form-group <?php echo ($_POST["password"]!==$_POST["cpassword"])?"has-error":""; ?>">
	    			<label for="cpassword">Confirm password</label>
				    <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm password" required>
				    <div class="help-block with-errors"></div>
					<?php if(isset($_POST["password"])&&isset($_POST["cpassword"])) echo ($_POST["password"]!==$_POST["cpassword"])?"<small class=\"text-danger\">confirmation password does not match password</small>":""; ?>
				</div>
			  	<div class="form-group">
				    <button type="submit" class="btn btn-default">Submit</button>
			 	</div>
	        </form> 	
       		<a href="../"><p>home</p></a>
   		</div>
	</body>
</html>