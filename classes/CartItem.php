<?php 

class CartItem
{
	private $_itemName;
	private $_quantity;
	private $_price;
	private $_productID;
	private $_photoPath;

	public function __construct($productID, $itemName, $quantity, $price, $photo)
	{
		$this->_productID = (int)$productID;
		$this->_itemName = $itemName;
		$this->_quantity = (int)$quantity;
		$this->_price = (float)$price;
		$this->_photoPath = $photo;
	}

	public function getQuantity(){
		return $this->_quantity;
	}

	public function setQuantity($value){
		if($value >= 0){
			$this->_quantity = (int)$value;
		} else {
			throw new Exception("Quantity must be positive");
		}
	}

	public function increaseQuantity($value){
		$this->_quantity += $value;
	}

	public function getPrice(){
		return $this->_price;
	}

	public function getTotalPrice(){
		return $this->_price * $this->_quantity;
	}

	public function getItemID(){
		return $this->_productID;
	}

	public function getItemName(){
		return $this->_itemName;
	}

	public function getPhoto(){
		return $this->_photoPath;
	}
}

?>