<?php 
	require_once "settings/required.php";
	require_once "classes/Authentication.php";

	$title = "Edit Categories";

	if(isset($_POST["changeName"])){
		if(isset($_POST["categoryID"]) && is_numeric($_POST["categoryID"])){
			if(test($_POST["newName"])){
				$sql = "SELECT 	COUNT(*)
						FROM 	Category
						WHERE 	categoryID = :id";
				$stmt = $pdo->prepare($sql);
				$stmt->bindValue(":id", $_POST["categoryID"], PDO::PARAM_INT);
				$result = $db->scalarSQL($stmt);

				if($result == 1){
					$sql = "UPDATE 	Category
							SET 	categoryName = :cN
							WHERE 	categoryID = :cID";
					$stmt = $pdo->prepare($sql);
					$stmt->bindValue(":cN", $_POST["newName"], PDO::PARAM_STR);
					$stmt->bindValue(":cID", $_POST["categoryID"], PDO::PARAM_INT);
					$db->executeNonQuery($stmt);
					Authentication::message("Success", "Category Has Been Updated");
					redirect();
				} else {
					Authentication::message("Update Failed", "Invalid Category ID Was Provided");
					redirect();
				}
			} else {
				Authentication::message("Update Failed", "No Name Was Provided");
				redirect();
			}
		} else {
			Authentication::message("Update Failed", "Don't Edit The HTML");
			redirect();
		}
	}

	if(isset($_POST["addCategory"])){
		if(test($_POST["newCategory"])){
				$sql = "INSERT INTO Category(categoryName)
					VALUES (:cN)";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":cN", $_POST["newCategory"]);
			$db->executeNonQuery($stmt);

			Authentication::message("Success", $_POST["newCategory"] . " Has Been Added");
		} else {
			Authentication::message("Failed", "No Category Name Was Provided");
			redirect();
		}
	}
	redirect();

	function test($field){
		if(strlen(trim($field)) > 0 && !empty(trim($field))){
			return true;
		} 
		return false;
	}

	function redirect(){
		header("Location: adminPage.php");
	}
?>