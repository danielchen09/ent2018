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
        <title>Hospital Finder-Medical History</title>
	</head>
	<body>
        <?php
            if(!isset($_SESSION["user"])){
                $_SESSION["redir"]="personalInfo/medHistory.php";
                header("Location: ../login/");
            }

            if(isset($_SESSION["submit"])&&$_SESSION["submit"]=true){
                echo "aaa";
                $db=new Database();
                $db->addMedHistory(unserialize($_SESSION["user"]), isset($_POST["name"])?$_POST["name"]:null, isset($_POST["status"])?$_POST["status"]:null, isset($_POST["start"])?$_POST["start"]:null);
                for($i=2; $i<=(int)$_SESSION["MHcount"]; $i++){
                    $db->addMedHistory(unserialize($_SESSION["user"]), isset($_POST["name" . $i])?$_POST["name" . $i]:null, isset($_POST["status" . $i])?$_POST["status" . $i]:null, isset($_POST["start" . $i])?$_POST["start" . $i]:null);
                }
                $_SESSION["submit"]=false;
            }

        ?>
    	<div class="jumbotron">
            <div class="container">
                <h1>Medical History</h1>
            </div>
    	</div>

    	
        <script>
            var count=1;
            var xmlhttp = new XMLHttpRequest();
            $(document).ready(function(){
                $("#more").click(function(){
                    count++;
                    $("#in1").clone().attr("id","in"+count).appendTo("#in");
                    $("#in"+count+" > #name").attr("name", "name"+count);
                    $("#in"+count+" > #start").attr("name", "start"+count);
                    $("#in"+count+" > #status").attr("name", "status"+count);
                    xmlhttp.open("GET", "saveVar.php?count=" + count, true);
                    xmlhttp.send();
                });
                $("#less").click(function(){
                    $("#in"+count).remove();
                    if(count>2) count--;
                    xmlhttp.open("GET", "saveVar.php?count=" + count, true);
                    xmlhttp.send();
                });
                $("#submit").click(function(){
                    xmlhttp.open("GET", "saveVar.php?submit=true", true);
                    xmlhttp.send();
                });
            });
        </script>

        <?php
        $_SESSION["MHcount"]=1;
        ?>
        <div class="container">
            <form method="POST" role="form" action="">
                <div class="form-group" id="in">
                    <div id="in1">
                        <label for="name">Name of medical condition</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                        <label for="name">Start year</label>
                        <input type="text" class="form-control" id="start" name="start" placeholder="YYYY">
                        <label for="inputState">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option selected value="N">status ...</option>
                            <option value="M">Stopped</option>
                            <option value="O">Continuing</option>
                        </select>
                        <br><br>
                    </div>
                </div>

            <div class="form-group">
                <button type="button" class="btn btn-default" id="more">more</button>
                <button type="button" class="btn btn-default" id="less">less</button>
            </div>
            <div class="form-group">
                <button type="submit" id="submit" name="redir" value="/personalInfo/medicine.php" class="btn btn-default">Next</button>
                <button type="submit" id="submit" name="redir" value="/profile" class="btn btn-default">Save and exit</button>
            </div>
            </form>
        </div>
	</body>
</html>