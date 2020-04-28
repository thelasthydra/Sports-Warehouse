<?php 
require_once("DBAccess.php");

class Authentication
{
	const LoginPageURL = "login.php";
	const SuccessPageURL = "adminPage.php";

	private static $_db;

	public static function message($status, $message){
		$_SESSION["message"] = "<strong>" . $status . ":</strong> " . $message;
	}

	public static function login($uname, $pword){
		session_regenerate_id();
		$hash = "";

		include "settings/db.php";

		try {
			self::$_db = new DBAccess($dsn, $username, $password);
		} catch (PDOException $e) {
			die("Unable to connect to the database, " . $e->message());
		}

		try {
			$pdo = self::$_db->connect();

			$sql = "SELECT 	password
					FROM 	User
					WHERE 	username = :u";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":u", $uname, PDO::PARAM_STR);

			$hash = self::$_db->scalarSQL($stmt);
		} catch (PDOException $e) {
			throw $e;
		}

		if(password_verify($pword, $hash)){
			$_SESSION["username"] = $uname;

			header("Location: " . self::SuccessPageURL);
			exit;
		} else {
			return false;
		}
	}

	public static function logout(){
		unset($_SESSION["username"]);
		session_regenerate_id();
		header("Location: " . self::LoginPageURL);
		exit;
	}

	public static function protect(){
		if(!isset($_SESSION["username"])){
			header("Location: " . self::LoginPageURL);
			exit;
		}
	}

	private static function findUser($uname){
		include "settings/db.php";

		try {
			self::$_db = new DBAccess($dsn, $username, $password);
		} catch (PDOException $e) {
			die("Unable To Connect To Database, " . $e->message());
		}

		try {
			$pdo = self::$_db->connect();

			$sql = "SELECT 	username 
					FROM 	User
					WHERE 	username = :u";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":u", $uname, PDO::PARAM_STR);
			$result = self::$_db->scalarSQL($stmt);

			if($uname == $result){
				return true;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			throw $e;
		}

	}

	public static function createUser($uname, $pword){
		$hash = password_hash($pword, PASSWORD_DEFAULT);

		include "settings/db.php";

		try{
			self::$_db = new DBAccess($dsn, $username, $password);
		} catch (PDOException $e) {
			die("Unable to connect to database, " . $e->message());
		}

		try {

			if(self::findUser($uname)){
				// Username Is Taken
				self::message("Failed", "Username Is Taken");
			} else {
				// Username Isn't Taken

				$pdo = self::$_db->connect();

				$sql = "INSERT INTO User(username, password) 
						VALUES(:u, :p)";
				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(":u", $uname, PDO::PARAM_STR);
				$stmt->bindParam(":p", $hash, PDO::PARAM_STR);

				$result = self::$_db->executeNonQuery($stmt);
			}
		} catch (PDOException $e){
			throw $e;
		}

		self::message("Success", "New User Added");
		return;
	}

	public static function deleteUser($uname){
		include "settings/db.php";

		try{
			self::$_db = new DBAccess($dsn, $username, $password);
		} catch (PDOException $e) {
			die("Unable to connect to database, " . $e->message());
		}

		try {
			if(self::findUser($uname)){
				$pdo = self::$_db->connect();
				$sql = "DELETE FROM User
						WHERE username = :u";

				$stmt = $pdo->prepare($sql);
				$stmt->bindValue(":u", $uname, PDO::PARAM_STR);
				self::$_db->executeNonQuery($stmt);
				self::message("Success", $uname . " Has Been Deleted");
				if($_SESSION["username"] == $uname){
					self::logout();
				}
			} else {
				self::message("Failed", "User Doesn't Exist");
			}
		} catch (PDOException $e) {
			throw $e;
		}
	}

	public static function changePassword($uname, $pword){
		session_regenerate_id();
		$hash = password_hash($pword, PASSWORD_DEFAULT);
		include "settings/db.php";

		try{
			self::$_db = new DBAccess($dsn, $username, $password);
		} catch (PDOException $e) {
			die("Unable to connect to database, " . $e->message());
		}

		try {
			if(self::findUser($uname)){
				$pdo = self::$_db->connect();

				$sql = "UPDATE	User 
						SET 	password = :p
						WHERE 	username = :u";

				$stmt = $pdo->prepare($sql);
				$stmt->bindValue(":p", $hash, PDO::PARAM_STR);
				$stmt->bindValue(":u", $_SESSION["username"], PDO::PARAM_STR);

				$result = self::$_db->executeNonQuery($stmt);
			}
		} catch (PDOException $e) {
			self::message("Failed", "Password Not Changed");
			throw $e;
		}
		self::message("Success", "Password Has Been Changed");
	}
}
?>