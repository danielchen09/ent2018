<!--personalInfo-->
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
	    <script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
	    <script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	    <link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
        <title>Hospital Finder-Login</title>
	</head>
	<body>
		<?php
			if(!isset($_SESSION["user"])){
				$_SESSION["redir"]="personalInfo";
				header("Location: ../login/");
			}
			$db=new Database();
			$db->updateUser(unserialize($_SESSION["user"]), isset($_POST["name"])?$_POST["name"]:null, isset($_POST["birthday"])?$_POST["birthday"]:null, isset($_POST["gender"])?$_POST["gender"]:null, isset($_POST["phone"])?$_POST["phone"]:null);
			if(isset($_POST["redir"])){
				header("Location: ../" . $_POST["redir"]);
			}
		?>
    	<div class="jumbotron">
    		<h1>PERSONAL INFORMATION</h1>
    		<p>optional</p>
    	</div>

        <div class="container">
	        <form method="POST" role="form">
	        	<div class="form-group">
	        		<label for="name">Name</label>
	        		<input type="text" class="form-control" id="name" name="name" placeholder="Name">
	        	</div>
				<div class="form-group">
					<label for="datetimepicker1">Birthday</label>
	                <div class='input-group date' id='datetimepicker1' >
	                    <input type='text' class="form-control" name="birthday" />
	                    <span class="input-group-addon">
	                        <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                </div>
           		</div>
           		<script type="text/javascript">
	            $(function () {
	                $('#datetimepicker1').datetimepicker({
	                	viewMode: 'years',
                		format: 'YYYY-MM-DD'
	                });
	            });
        		</script>
        		<div class="form-group">
					<label for="inputState">Gender</label>
					<select id="inputState" class="form-control" name="gender">
						<option selected value="N">gender ...</option>
						<option value="M">Male</option>
						<option value="F">Female</option>
						<option value="O">Other</option>
					</select>
				</div>
        		<div class="form-group">
	        		<label for="phone">Phone Number</label>
	        		<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone">
	        	</div>

	        	<div class="row">
				  	<div class="form-group col-lg-1">
					    <button type="submit" name="redir" value="/personalInfo/medHistory.php" class="btn btn-default">Next</button>
				 	</div>
				 	<div class="form-group col-lg-1">
					    <button type="submit" name="redir" value="/profile" class="btn btn-default">Save and exit</button>
				 	</div>
			 	</div>
	        </form> 	
       		<a href="../"><p>home</p></a>
   		</div>
	</body>
</html>