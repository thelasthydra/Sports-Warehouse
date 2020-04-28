<?php 

	require_once "settings/required.php";

	$title = "Home Page";

	ob_start();

	include "templates/slideshow.html.php";

	$sql = "SELECT 	itemID, photo, itemName, price, onSale, salePrice
			FROM 	Item
			WHERE 	featured = 1
			LIMIT 	5";

	$stmt = $pdo->prepare($sql);

	$rows = $db->executeSQL($stmt);

	include "templates/featuredProducts.html.php";

	include "templates/partners.html.php";

	$output = ob_get_clean();

	include "templates/layout.html.php";

?>