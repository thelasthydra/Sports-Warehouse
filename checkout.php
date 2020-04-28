<?php 
	require_once "settings/required.php";

	$title = "Checkout";

	$cart = $_SESSION["cart"];

	$ordered = false;

	if(isset($_POST["submit"])){
		$requiredFields = [$_POST["fname"], $_POST["lname"], $_POST["address"], $_POST["phone"], $_POST["creditCard"], $_POST["month"], $_POST["year"], $_POST["cardName"]];
		// Phone, Credit Card & Month/Year Need Extra Validation
		if(testArray($requiredFields)){
			$isValid = true;
			// Tests To See If The Phone Field Has Any Content Passed Through
			if(test($_POST["phone"])){
				// Removes Spaces Between Numbers
				$phone = str_replace(' ', '', $_POST["phone"]);
			} else {
				$isValid = false;
			}

			// Makes Sure The Credit Card Number Is 16 Characters Long
			$creditCard = str_replace(' ', '', $_POST["creditCard"]);
			if(strlen($creditCard) != 16){
				$isValid = false;
			}

			// Makes Sure The Month Is Inbetween 1 & 12
			$month = $_POST["month"];
			if(testExpire($month)){
				if($month < 1 && $month > 12){
					$isValid = false;
				}
			} else {
				$isValid = false;
			}

			// Checks To See If The Year Is Equal To Or Greater Then The current Year
			$year = $_POST["year"];
			$currentYear = date("y");
			if(testExpire($year)){
				if($year > $currentYear){

				} elseif($year == $currentYear){
					$currentMonth = date("M");
					if($month < $currentMonth){
						$isValid = false;
					}
				} else {
					$isValid = false;
				}
			}

			if($isValid){
				// Enter Shit Into Database
				$_SESSION["orderID"] = $cart->processOrder($_POST["fname"], $_POST["lname"], $_POST["address"], $phone, $_POST["email"], $creditCard, $month, $year, $_POST["cardName"]);

				$ordered = true;
			} else {
				// 1 or More Fields Are Invalid
				$_SESSION["cart-message"] = "One Or More Fields Are Invalid, Please Try Again";
			}
		} else {
			$_SESSION["cart-message"] = "Something Went Wrong, Please Try Again";
		}
	}

	if($ordered){
		ob_start();

		include "templates/thanks.html.php";
	} else {
		ob_start();

		include "templates/checkout.html.php";
	}	

	$output = ob_get_clean();

	include "templates/layout.html.php";

	function testArray($reqFields){
		$bool = true;
		foreach ($reqFields as $field) {
			if(strlen(trim($field)) < 0 || empty(trim($field)))
			{
				$bool = false;
			} 
		}
		return $bool;
	}

	function test($field){
		if(strlen(trim($field)) > 0 && !empty(trim($field))){
			return true;
		}
		return false;
	}

	function testExpire($field){
		if(is_numeric($field) && strlen($field) == 2){
			return true;
		}
		return false;
	}
?>