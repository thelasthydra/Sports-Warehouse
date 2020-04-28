<?php
	class DBAccess
	{
		private $_DSN;
		private $_username;
		private $_password;
		private $_pdo;

		public function __construct($DSN, $username, $password){
			$this->_DSN = $DSN;
			$this->_username = $username;
			$this->_password = $password;
		}

		public function connect(){
			try {
				$this->_pdo = new PDO($this->_DSN, $this->_username, $this->_password);
				$this->_pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			} catch (PDOException $e) {
				die("Connection Failed: " . $e->getMessage());
			}

			return $this->_pdo;
		}

		public function disconnect(){
			$this->_pdo = "";
		}

		// Return Multiple Values In Multiple Rows
		public function executeSQL($sql){
			try {
				$sql->execute();
				$rows = $sql->fetchAll();
			} catch (Exception $e) {
				die("Query Failed: " . $e->getMessage());
			}

			return $rows;
		}

		// Return Single Value
		public function scalarSQL($sql){
			try {
				$sql->execute();
				$value = $sql->fetchColumn();
			} catch (PDOException $e) {
				die("Query Failed: " . $e->getMessage());
			}

			return $value;
		}

		public function rowSQL($sql){
			try {
				$sql->execute();
				$row = $sql->fetch();
			} catch (PDOException $e) {
				die("Query Failed: " . $e->getMessage());
			}
			return $row;
		}

		public function executeNonQuery($stmt, $pkid=false){
			try {
				$value = $stmt->execute();

				if ($pkid == true) {
					$value = $this->_pdo->lastInsertId();
				}
			} catch (PDOException $e) {

				if($e->getCode() == 23000){
					$value = -1;
				}
				else {
					die("Query Failed: " . $e->getMessage());
				}
			}

			return $value;
		}
	}
?>