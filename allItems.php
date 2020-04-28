<?php 

	require_once "settings/required.php";

	$title = "All Items";

	$sql = "SELECT 	itemID, photo, itemName, price, onSale, salePrice
			FROM 	Item";

	$stmt = $pdo->prepare($sql);

	$rows = $db->executeSQL($stmt);

	include "templates/allItems.html.php";

	include "templates/partners.html.php";

	$output = ob_get_clean();

	include "templates/layout.html.php";

?>