<?php 

require_once "CartItem.php";
require_once "DBAccess.php";

class ShoppingCart
{
	private $_cartItems = [];
	private $_shoppingOrderID;

	private function inCart($cartItem){
		$found = null;

		foreach($this->_cartItems as $item){
			if($item->getItemID() == $cartItem->getItemID()){
				$found = $item;
			}
		}
		return $found;
	}

	private function itemIndex($cartItem){
		$index = -1;

		for($i=0; $i<$this->count(); $i++){
			if($cartItem->getItemID() == $this->_cartItems[$i]->getItemID()){
				$index = $i;
			}
		}
		return $index;
	}

	public function count(){
		return count($this->_cartItems);
	}

	// public function setShoppingOrderID($id){
	// 	$this->_shoppingOrderID = (int)$id;
	// }

	public function getItems(){
		return $this->_cartItems;
	}

	public function addItem($cartItem){
		$found = $this->inCart($cartItem);

		if($found != null){
			$this->updateItem($cartItem);
		} else {
			$this->_cartItems[] = $cartItem;
		}
	}

	public function updateItem($cartItem){
		$index = $this->itemIndex($cartItem);
		
		//get old quantity
		$oldQty = $this->_cartItems[$index]->getQuantity();
		//get added quantity
		$additionalQty = $cartItem->getQuantity();
		
		//calculate new quantity
		$newQty = $oldQty + $additionalQty;
		
		//update cart item with new quatity
		$this->_cartItems[$index]->setQuantity($newQty);
	}

	public function setQuantity($cartItem, $qty){
		$index = $this->itemIndex($cartItem);

		if($index != -1){
			$this->_cartItems[$index]->setQuantity($qty);
		}
	}

	public function removeItem($cartItem){
		$index = $this->itemIndex($cartItem);

		if($index >= 0){
			unset($this->_cartItems[$index]);

			$this->_cartItems = array_values($this->_cartItems);
		}
	}

	public function calculateTotal(){
		$total = 0.0;

		foreach($this->_cartItems as $item){
			$total += $item->getQuantity() * $item->getPrice();
		}

		return $total;
	}

	public function processOrder($fName, $lName, $address, $phone, $email, $creditCard, $month, $year, $cardHolder)
	{
		include "settings/db.php";

		$db = new DBAccess($dsn, $username, $password);
		$pdo = $db->connect();

		$sql = "INSERT INTO ShoppingOrder(firstName, lastName, address, phone, email, creditCard, expireMonth, expireYear, cardHolder) VALUES(:fN, :lN, :a, :ph, :e, :cc, :mm, :yy, :cH)";

		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":fN", $fName, PDO::PARAM_STR);
		$stmt->bindValue(":lN", $lName, PDO::PARAM_STR);
		$stmt->bindValue(":a", $address, PDO::PARAM_STR);
		$stmt->bindValue(":ph", $phone, PDO::PARAM_STR);
		$stmt->bindValue(":e", $email, PDO::PARAM_STR);
		$stmt->bindValue(":cc", $creditCard, PDO::PARAM_STR);
		$stmt->bindValue(":mm", $month, PDO::PARAM_STR);
		$stmt->bindValue(":yy", $year, PDO::PARAM_STR);
		$stmt->bindValue(":cH", $cardHolder, PDO::PARAM_STR);

		$orderID = $db->executeNonQuery($stmt, true);

		foreach($this->_cartItems as $item){
			$sql = "INSERT INTO 
						OrderItem(itemID, buyPrice, qty, orderID)
						VALUES(:iID, :p, :q, :soID)";

			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":iID", $item->getItemID(), PDO::PARAM_INT);
			$stmt->bindValue(":p", $item->getPrice(), PDO::PARAM_STR);
			$stmt->bindValue(":q", $item->getQuantity(), PDO::PARAM_INT);
			$stmt->bindValue("soID", $orderID, PDO::PARAM_INT);

			$db->executeNonQuery($stmt);
		}

		return $orderID;
	}

	public function displayArray(){
		print_r($this->_cartItems);
	}

}

?>