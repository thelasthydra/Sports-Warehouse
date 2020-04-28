<?php 
	require_once "settings/required.php";

	$title = "Shopping Cart";

	if(isset($_POST["clear"])){
		// Clears The Cart (Removes All Items From The Cart)
		unset($_SESSION["cart"]);
	}

	if(isset($_POST["submit"])){
		// Continues Through To Checkout
		header("Location: checkout.php");
	}

	if(isset($_POST["update"])){
		// Updates The Item Quantity
		if(emptyNumeric($_POST["qty"]) && emptyNumeric($_POST["itemID"]) || $_POST["qty"] == 0){
			$item = new CartItem($_POST["itemID"], "", 0, 0, "");

			if($_POST["qty"] <= 0){
				$_SESSION["cart"]->removeItem($item);
			} else {
				$_SESSION["cart"]->setQuantity($item, $_POST["qty"]);
			}
		}
	}

	if(isset($_POST["remove"])){
		// Removes The Item From The Cart
		if(emptyNumeric($_POST["itemID"])){
			$item = new CartItem($_POST["itemID"], "", 0, 0, "");

			$_SESSION["cart"]->removeItem($item);
		}
	}

	ob_start();

	include "templates/shoppingCart.html.php";

	$output = ob_get_clean();

	include "templates/layout.html.php";

	function emptyNumeric($field){
		// Checks to see if the field is not empty & is numeric. Used for Quantity & ItemID
		if(!empty($field) && is_numeric($field)){
			return true;
		} else {
			return false;
		}
	}
?>