<main>
	<h2>Change Password</h2>
	<form action="changePassword.php" method="post" class="form" id="changePassword">
		<fieldset>
			<p>
				<label for="username">Username:</label>
				<input class="input xl" type="text" name="username" id="username" placeholder="Admin" required autofocus value="<?=$_SESSION["username"];?>" disabled>
			</p>
			<p>
				<label for="password">New Password:</label>
				<input class="input xl" type="password" name="password" id="password" placeholder="New Password" required>
			</p>
			<p>
				<label for="confirmPassword">Confirm Password:</label>
				<input class="input xl" type="password" name="confirmPassword" id="confirmPassword" placeholder="New Password" required>
			</p>
			<p>
				<input type="submit" name="submit" class="submit" value="Change Password">
			</p>
		</fieldset>
		<input type="submit" name="back" value="&lt;  Back" class="clear back">
	</form>
</main>