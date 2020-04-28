<?php 

	require_once "classes/Authentication.php";

	session_start();

	$title = "Deleting User...";

	Authentication::protect();

	if(isset($_POST["delete"])){
		Authentication::deleteUser($_POST["username"]);
	}

	if(isset($_POST["back"])){
		header("Location: adminPage.php");
	}
	header("Location: adminPage.php");
?>