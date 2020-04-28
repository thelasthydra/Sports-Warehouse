<?php 
	$sql = "SELECT 	username 
			FROM 	User";
	$stmt = $pdo->prepare($sql);
	$rows = $db->executeSQL($stmt);
?>
<main>
	<h2>Delete User</h2>

	<form action="deleteUser.php" method="post" class="form">
		<fieldset>
			<legend>Select User To Delete</legend>
		
			<p>
				<select name="username">
					<?php foreach($rows as $data): ?>
						<option value="<?=$data["username"];?>"><?=$data["username"];?></option>
					<?php endforeach; ?>
				</select>
			</p>
			<p>
				<input type="submit" name="delete" value="Delete User" class="remove" onclick="return confirm('Are You Sure You Wish To Delete This User?');">
			</p>
		</fieldset>
		<input type="submit" name="back" value="&lt;  Back" class="clear back">
	</form>
</main>