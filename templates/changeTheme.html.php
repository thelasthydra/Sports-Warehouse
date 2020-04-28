<main>
	<h2>Change Theme</h2>
	<form action="changeTheme.php" method="post" class="form">
		<fieldset>
			<p>
				<label>Select Theme:</label>
				<select name="theme" class="input medium">
					<option value="default">Default</option>
					<option value="1">Alternate One</option>
					<option value="2">Alternate Two</option>
					<option value="3">Alternate Three</option>
					<option value="4">Alternate Four</option>
					<option value="christmas">Christmas Theme</option>
				</select>
			</p>
			<p>
				<input type="submit" name="submit" class="submit" value="Change Theme">
			</p>
		</fieldset>
		<input type="submit" name="back" value="&lt;  Back" class="clear back">
	</form>
</main>