<?php 
	require_once "settings/required.php";
	require_once "classes/Authentication.php";

	$title = "Edit Item";

	Authentication::protect();

	if(isset($_POST["submit"])){
		$reqFields = [$_POST["name"], $_POST["price"], $_POST["salePrice"], $_POST["category"]];
		$isValid = true;
		if(testArray($reqFields)){
			if(is_double($_POST["price"])){
				$isValid = false;
			}

			if(isset($_POST["salePrice"])){
				if(is_double($_POST["salePrice"])){
					$isValid = false;
				}
			}

			if(isset($_POST["onSale"])){
				$onSale = 1;
			} else {
				$onSale = 0;
			}
			if(isset($_POST["featured"])){
				$featured = 1;
			} else {
				$featured = 0;
			}

			if(!isset($_POST["category"]) && !is_numeric($_POST["category"])){
				$isValid = false;
			}

			if(!isset($_POST["id"]) && !is_numeric($_POST["id"])){
				$isValid = false;
			}

			if($isValid == true){
				$sql = "UPDATE 	Item 
						SET itemName = :iName, 
						price = :price, 
						salePrice = :sP, 
						onSale = :oS, 
						description = :des, 
						featured = :f, 
						categoryID = :cID
						WHERE 	itemID = :iID";
				$stmt = $pdo->prepare($sql);
				$stmt->bindValue(":iName", $_POST["name"], PDO::PARAM_STR);
				$stmt->bindValue(":price", $_POST["price"]);
				$stmt->bindValue(":sP", $_POST["salePrice"]);
				$stmt->bindValue(":oS", $onSale, PDO::PARAM_BOOL);
				$stmt->bindValue(":des", $_POST["desc"], PDO::PARAM_STR);
				$stmt->bindValue(":f", $featured, PDO::PARAM_BOOL);
				$stmt->bindValue(":cID", $_POST["category"], PDO::PARAM_INT);
				$stmt->bindValue(":iID", $_POST["id"], PDO::PARAM_INT);
				$db->executeNonQuery($stmt);
				
				Authentication::message("Success", htmlspecialchars($_POST["name"]) . " Has Been Updated");
				header("Location: adminPage.php");
			} else {
				Authentication::message("Failed", "Field Input Was Incorrect");
				header("Location: adminPage.php");
			}
		} else {
			Authentication::message("Failed", "Item Wasn't Added, Something Went Wrong");
			// header("Location: adminPage.php");
		}
	} 

	if(isset($_GET["item"]) && is_numeric($_GET["item"])){
		ob_start();

		include "templates/editItem.html.php";

		$output = ob_get_clean();

		include "templates/adminLayout.html.php";
	} else {
		header("Location: adminPage.php?type=editItem");
	}

	function testArray($reqFields){
		$bool = true;
		foreach ($reqFields as $field) {
			if(strlen(trim($field)) < 0 || empty(trim($field)))
			{
				$bool = false;
				echo '<script type="text/javascript">console.log(' . $field . ')</script>';
			} 
		}
		return $bool;
	}
?>