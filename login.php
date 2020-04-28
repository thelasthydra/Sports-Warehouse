<?php 

	require_once "settings/required.php";
	require_once "classes/Authentication.php";

	$title = "Admin Login";

	if(isset($_POST["submit"])){
		if(isset($_POST["password"]) && isset($_POST["username"])){
			Authentication::login($_POST["username"], $_POST["password"]);
		}
	}
	
	ob_start();

	include "templates/login.html.php";

	$output = ob_get_clean();

	include "templates/adminLayout.html.php";

?>