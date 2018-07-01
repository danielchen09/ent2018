<?php
	session_start();
	$var=$_REQUEST["count"];
	$_SESSION["MHcount"] = $var;
	$var=$_REQUEST["submit"];
	$_SESSION["submit"]=$var;
?>