<main>
	<h2>Login</h2>
	<form action="login.php" method="post" class="form">
		<fieldset>
			<p>
				<label for="username">Username:</label>
				<input class="input xl" type="text" name="username" id="username" placeholder="Admin" required autofocus>
			</p>
			<p>
				<label for="password">Password:</label>
				<input class="input xl" type="password" name="password" id="password" placeholder="Password" required>
			</p>
			<p>
				<input type="submit" name="submit" class="submit" value="Login">
			</p>
			<!-- <p class="error-message">Test<?=$message;?></p> -->
		</fieldset>
	</form>
</main>