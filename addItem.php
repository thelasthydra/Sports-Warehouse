<?php 
	require_once "settings/required.php";
	require_once "classes/Authentication.php";
	require_once "classes/DBImage.php";

	$title = "Add Item";

	Authentication::protect();

	if(isset($_POST["submit"])){
		$fileName = DBImage::updloadImg($_FILES["img"]);
		// IT WORKS!
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

			if($isValid == true){
				$sql = "INSERT INTO Item(itemName, photo, price, salePrice, onSale, description, featured, categoryID)
						VALUES(:iName, :photo, :price, :sP, :oS, :des, :f, :cID)";
				$stmt = $pdo->prepare($sql);
				$stmt->bindValue(":iName", $_POST["name"], PDO::PARAM_STR);
				$stmt->bindValue(":photo", $fileName, PDO::PARAM_STR);
				$stmt->bindValue(":price", $_POST["price"]);
				$stmt->bindValue(":sP", $_POST["salePrice"]);
				$stmt->bindValue(":oS", $onSale, PDO::PARAM_BOOL);
				$stmt->bindValue(":des", $_POST["desc"], PDO::PARAM_STR);
				$stmt->bindValue(":f", $featured, PDO::PARAM_BOOL);
				$stmt->bindValue(":cID", $_POST["category"], PDO::PARAM_INT);
				$db->executeNonQuery($stmt);
				Authentication::message("Success", htmlspecialchars($_POST["name"]) . " Has Been Added");
				header("Location: adminPage.php");
			} else {
				Authentication::message("Failed", "Field Input Was Incorrect");
				header("Location: adminPage.php");
			}
		} else {
			Authentication::message("Failed", "Item Wasn't Added, Something Went Wrong");
			// header("Location: adminPage.php");
		}
	} else {
		header("Location: adminPage.php");
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

