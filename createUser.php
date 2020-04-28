<?php 

	require_once "settings/required.php";
	require_once "classes/Authentication.php";

	$title = "Create User";

	if(isset($_POST["submit"])){
		if(isset($_POST["password"]) && isset($_POST["username"])){
			Authentication::createUser($_POST["username"], $_POST["password"]);

			Authentication::login($_POST["username"], $_POST["password"]);
		}
	}
	header("Location: adminPage.php");
?>