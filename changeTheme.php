<?php 

	session_start();

	$title = "Change Theme";

	if(isset($_POST["submit"])){
		switch ($_POST["theme"]) {
			case '1':
				$_SESSION["theme"] = "altOne";
				break;
			case '2':
				$_SESSION["theme"] = "altTwo";
				break;
			case '3':
				$_SESSION["theme"] = "altThree";
				break;
			case '4':
				$_SESSION["theme"] = "altFour";
				break;
			case 'christmas':
				$_SESSION["theme"] = "christmas";
				break;

			default:
				$_SESSION["theme"] = "style";
				break;
		}
		$_SESSION["theme"] .= ".css";
	}

	if(isset($_POST["back"])){
		header("Location: adminPage.php");
	}
	header("Location: adminPage.php");
?>