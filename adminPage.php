<?php 
	
	require_once "settings/required.php";
	require_once "classes/Authentication.php";

	$title = "Admin Page";

	Authentication::protect();

	// Stuff Here

	// Include Body Here

	if(isset($_GET["type"])){

		switch ($_GET["type"]) {
			case 'changePassword':
				ob_start();
				include "templates/changePassword.html.php";
				break;
			case 'createUser':
				ob_start();
				include "templates/createUser.html.php";
				break;
			case 'deleteUser':
				ob_start();
				include "templates/deleteUser.html.php";
				break;
			case 'category':
				ob_start();
				include "templates/adminCategories.html.php";
				break;
			case 'addItem':
				ob_start();
				include "templates/addItem.html.php";
				break;
			case 'editItem':
				ob_start();
				include "templates/adminItems.html.php";
				break;
			case 'changeTheme':
				ob_start();
				include "templates/changeTheme.html.php";
				break;
			
			default:
				ob_start();
				include "templates/adminPage.html.php";
				break;
		}
		
	} else {
		ob_start();
		include "templates/adminPage.html.php";
	}

	$output = ob_get_clean();

	include "templates/adminLayout.html.php";
?>