<?php 
	$sql = "SELECT 	categoryID, categoryName
			FROM  	Category";
	$stmt = $pdo->prepare($sql);
	$rows = $db->executeSQL($stmt);
?>

<main>
	<h2>Categories</h2>
	<form class="form" action="adminCategories.php" method="post">
		<fieldset>
			<legend>Change Category Name</legend>
			<p>
				<label for="categoryID">Select Category:</label>
				<select name="categoryID" class="input medium">
					<?php foreach($rows as $data): ?>
						<option value="<?=$data["categoryID"];?>"><?=$data["categoryName"];?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<label>New Name:</label>
				<input type="text" name="newName" class="input long">
			</p>
			<p>
				<input type="submit" name="changeName" class="submit" value="Apply Changes">
			</p>
		</fieldset>
		<fieldset>
			<legend>Add New Category</legend>
			<p>
				<label>Category Name:</label>
				<input type="text" name="newCategory" class="input long" placeholder="New Category Name">
			</p>
			<p>
				<input type="submit" name="addCategory" class="submit" value="Add Category">
			</p>
		</fieldset>
		<input type="submit" name="back" class="clear back" value="&lt;  Back">
	</form>
</main>