<?php 
$sql = "SELECT 	categoryID, categoryName
		FROM 	Category";
$stmt = $pdo->prepare($sql);
$categories = $db->executeSQL($stmt);
?>
<main>
	<h2>Add Item</h2>
	<form action="addItem.php" method="post" class="form" enctype="multipart/form-data">
		<fieldset>
			<legend>Enter New Item Details Below</legend>
			<p>
				<label for="img">Image:</label>
				<input type="file" name="img" id="img" required>
			</p>
			<p>
				<label for="name">Item Name:</label>
				<input type="text" name="name" class="input xl" placeholder="Item Name" min="2" required>
			</p>
			<p>
				<label for="">Price:</label>
				<input type="number" name="price" class="input small" step=".01" min="1" placeholder="87.92" required>
			</p>
			<p>
				<label for="salePrice">Sale Price:</label>
				<input type="number" name="salePrice" class="input small" step=".01" min="1" placeholder="75.95">
			</p>
			<p>
				<label for="onSale">On Sale:</label>
				<input type="checkbox" name="onSale">
			</p>
			<p>
				<label for="featured">Featured:</label>
				<input type="checkbox" name="featured">
			</p>
			<p>
				<label for="category">Category</label>
				<select name="category" class="input medium">
					<?php foreach($categories as $cat): ?>
						<option value="<?=$cat["categoryID"];?>"><?=$cat["categoryName"];?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label for="desc">Item Description:</label>
				<textarea name="desc" minlength="8" class="input"></textarea>
			</p>
			<p>
				<input type="submit" name="submit" class="submit" value="Add Item">
			</p>
		</fieldset>
		<input type="submit" name="back" class="clear back" value="&lt;  Back">
	</form>
</main>