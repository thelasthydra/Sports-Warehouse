<?php
	
	if($_SERVER["SERVER_NAME"] == "localhost" || $_SERVER["SERVER_ADDR"] == "127.0.0.1"){

		$dsn = "mysql:host=localhost;dbname=assignment;charset=utf8";
		$username = "root";
		$password = "";

	} else {

		$dsn = "mysql:host=localhost;dbname=zanefrendin_sw;charset=utf8";
		$username = "zanefrendin_sw";
		$password = "8Wjl8Tuh4Rb8";
		
	}

?>