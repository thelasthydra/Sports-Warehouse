<?php 
	require_once "classes/DBAccess.php";
	require_once "classes/ShoppingCart.php";
	require_once "settings/db.php";

	session_start();

	$db = new DBAccess($dsn, $username, $password);

	$pdo = $db->connect();
?>