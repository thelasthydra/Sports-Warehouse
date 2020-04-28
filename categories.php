<?php 

	require_once "settings/required.php";

	if(isset($_GET["cat"]) && strlen($_GET["cat"])){

		$sql = "SELECT 	COUNT(categoryName)
				FROM 	Category
				WHERE 	categoryID = :id";

		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id", $_GET["cat"], PDO::PARAM_INT);

		$rows = $db->scalarSQL($stmt);

		// Checks To See If Category Exists, If It Doesn't It Redirects To Homepage.
		if($rows > 0) {
			// Gets Category Name For Website Title
			$sql = "SELECT 	categoryName
					FROM 	Category
					WHERE 	categoryID = :id";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":id", $_GET["cat"], PDO::PARAM_INT);

			$title = $db->scalarSQL($stmt);

			// ----------------------------------------------------

			// Brings Back All Items In The Category
			$sql = "SELECT 	itemID, itemName, photo, price, salePrice, onSale, categoryID
					FROM 	Item
					WHERE 	categoryID = :id";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":id", $_GET["cat"], PDO::PARAM_INT);

			$rows = $db->executeSQL($stmt);

			ob_start();

			include "templates/category.html.php";

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