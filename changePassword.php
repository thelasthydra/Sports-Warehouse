<?php 

	require_once "settings/required.php";
	require_once "classes/Authentication.php";

	$title = "Changing Password";

	Authentication::protect();

	if(isset($_POST["submit"])){
		if(isset($_POST["password"]) || isset($_POST["confirmPassword"])){
			$newPass = $_POST["password"];

			if ($newPass == $_POST["confirmPassword"]){
				Authentication::changePassword($_SESSION["username"], $newPass);
				session_regenerate_id();
			} else {
				header("Location: adminPage.php?type=changePassword");
			}
		} else {
			$_SESSION["message"] = "Something Went Wrong With The Inputs";
		}
	} else {
		header("Location: adminPage.php?type=changePassword");
	}

	header("Location: adminPage.php");
?>