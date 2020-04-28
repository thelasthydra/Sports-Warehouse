<?php 

	require_once "settings/required.php";

	$title = "Selected Item";

	if(isset($_GET["id"]) && strlen($_GET["id"])){
		$sql = "SELECT 	COUNT(itemID)
				FROM 	Item
				WHERE 	itemID = :id";

		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id", $_GET["id"], PDO::PARAM_INT);

		$rows = $db->scalarSQL($stmt);

		if ($rows > 0) {

			$sql = "SELECT 	itemID, itemName, photo, price, salePrice, onSale, description
				FROM 	Item
				WHERE 	itemID = :id";

			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":id", $_GET["id"], PDO::PARAM_INT);

			$rows = $db->executeSQL($stmt);

			ob_start();

			include "templates/selectedItem.html.php";

			include "templates/partners.html.php";

			$output = ob_get_clean();

			include "templates/layout.html.php";

		} else {
			header("Location: index.php");
		}

	} else {
		header("Location: index.php");
	}


?>