<?php 
	
	require_once "settings/required.php";

	$title = "Search";

	if(isset($_POST["btnSearch"])){
		
		if(isset($_POST["search"]) && !empty($_POST["search"])){
			// If Search Has Something In It
			$sql = "SELECT 	itemID, itemName, photo, price, salePrice, onSale
					FROM 	Item
					WHERE 	itemName like :search
					LIMIT 	10;";

			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":search", "%" . $_POST["search"] . "%", PDO::PARAM_STR);
			$rows = $db->executeSQL($stmt);

			ob_start();

			include "templates/searchResults.html.php";

			include "templates/partners.html.php";

		} else {
			header("Location: index.php");
		}

		$output = ob_get_clean();

		include "templates/layout.html.php";

	} else {
		header("Location: index.php");
	}
?>