<?php 

	require_once "classes/CartItem.php";
	require_once "classes/ShoppingCart.php";

	session_start();

	$title = "Adding Items To Cart";

	if(isset($_POST["submit"])){
		$qty = $_POST["qty"];
		if($qty >= 1){
			$item = new CartItem($_POST["id"], $_POST["name"], $qty, $_POST["price"], $_POST["photo"]);

			if(!isset($_SESSION["cart"])){
				$cart = new ShoppingCart();
			} else {
				$cart = $_SESSION["cart"];
			}

			$cart->addItem($item);

			$cart->displayArray();

			$_SESSION["cart"] = $cart;
		}
	}
	header("Location: cartItems.php");
?>