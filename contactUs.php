<?php 

	require_once "settings/required.php";

	$title = "Contact Us";

	if(isset($_POST["submit"])){
		
		if(test($_POST["firstName"])){
			alert("First Name Is Required For Us To Contact You");
		}

		if(test($_POST["lastName"])){
			alert("Last Name Is Required For Us To Contact You");
		}

		if(test($_POST["email"])){
			alert("Email Is Required To Contact You");
		}
	}

	ob_start();

	include "templates/contactForm.html.php";

	$output = ob_get_clean();

	include "templates/layout.html.php";


	function test($i){
		if(!isset($i) || !trim($i)){
			return true;
		}
		return false;
	}

	function alert($msg){
		echo "<script type='text/javascript'>
		alert('$msg');</script>";
	}

?>