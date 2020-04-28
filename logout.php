<?php 
	session_start();
	require_once "classes/Authentication.php";
	Authentication::logout();
?>