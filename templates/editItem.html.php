<?php 
	if(isset($_GET["item"]) && is_numeric($_GET["item"])){
		$sql = "SELECT 	COUNT(*)
				FROM 	Item
				WHERE 	itemID = :id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(":id", $_GET["item"], PDO::PARAM_STR);
		$itemCount = $db->scalarSQL($stmt);

		if($itemCount == 1){
			$sql = "SELECT 	itemName, price, salePrice, onSale, description, featured, categoryID
					FROM 	Item
					WHERE 	itemID = :id";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(":id", $_GET["item"], PDO::PARAM_STR);
			$item = $db->rowSQL($stmt);

			$sql = "SELECT 	categoryID, categoryName
					FROM 	Category";
			$stmt = $pdo->prepare($sql);
			$categories = $db->executeSQL($stmt);
		} else {
			header("Location: adminPage.php");
		}		
	}
?>
<main>
	<h2>Edit Item</h2>
	<form action="editItem.php" method="post" class="form">
		<fieldset>
			<legend>Editing: <?=$item["itemName"];?></legend>
			<p>
				<label for="name">Item Name:</label>
				<input type="text" name="name" value="<?=$item["itemName"];?>" class="input xl" placeholder="<?=$item["itemName"];?>">
			</p>
			<p>
				<label for="">Price:</label>
				<input type="number" name="price" class="input small" step="any" min="1" placeholder="<?=$item["price"];?>" value="<?=$item["price"];?>">
			</p>
			<p>
				<label for="salePrice">Sale Price:</label>
				<input type="number" name="salePrice" class="input small" step="any" min="1" placeholder="<?=$item["salePrice"];?>"
				value="<?=$item["salePrice"];?>">
			</p>
			<p>
				<label for="onSale">On Sale</label>
				<input type="checkbox" name="onSale" <?php if($item["onSale"] == 1){echo "checked";} ?>>
			</p>
			<p>
				<label for="featured">Featured:</label>
				<input type="checkbox" name="featured" <?php if($item["featured"] == 1){echo "checked";}?>>
			</p>
			<p>
				<label for="category">Category</label>
				<select name="category" class="input medium">
					<?php foreach($categories as $cat): ?>
						<?php if($item["categoryID"] == $cat["categoryID"]): ?>
							<option value="<?=$cat["categoryID"];?>" selected><?=$cat["categoryName"];?></option>
						<?php else: ?>
							<option value="<?=$cat["categoryID"];?>"><?=$cat["categoryName"];?></option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="desc">Item Description:</label>
				<textarea name="desc" minlength="8" class="input" placeholder="<?=$item["description"];?>"><?=$item["description"];?></textarea>
			</p>
			<p>
				<input type="hidden" name="id" value="<?=$_GET["item"];?>">
				<input type="submit" name="submit" class="submit" value="Update Item">
			</p>
		</fieldset>
		<input type="submit" name="back" class="clear back" value="&lt;  Back">
	</form>
</main>