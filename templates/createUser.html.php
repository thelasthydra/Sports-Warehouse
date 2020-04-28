<main>
	<h2>Create New User</h2>
	<form action="createUser.php" method="post" class="form">
		<fieldset>
			<p>
				<label for="username">Username:</label>
				<input class="input xl" type="text" name="username" id="username" placeholder="Admin" required autofocus>
			</p>
			<p>
				<label for="password">Password:</label>
				<input class="input xl" type="password" name="password" id="Password" placeholder="password" required>
			</p>
			<p>
				<input type="submit" name="submit" class="submit" value="Create User">
			</p>
		</fieldset>
		<input type="submit" name="back" class="clear back" value="&lt;  Back">
	</form>
</main>