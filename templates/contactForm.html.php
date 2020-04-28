<main>
	<h2>Contact Us</h2>
	<form action="contactUs.php" method="post" class="form" id="contactUs">
		<fieldset>
			<p>
				<label for="firstName">First Name:</label>
				<input class="input medium" type="text" name="firstName" id="lastname" placeholder="John" required autofocus>
			</p>
			<p>
				<label for="lastName">Last Name:</label>
				<input class="input medium" type="text" name="lastName" id="lastName" placeholder="Doe" required>
			</p>
			<p>
				<label for="contactNum">Contact Number:</label>
				<input class="input xl" type="text" name="contactNum" id="contactNum" placeholder="0404 040 404">
			</p>
			<p>
				<label for="email">Email Address:</label>
				<input class="input xl" type="email" name="email" id="email" placeholder="email@gmail.com" required>
			</p>
			<br>
			<p>
				<label for="question" id="questLabel">Question:</label>
				<textarea class="input" name="question" required></textarea>
			</p>
			<br>
			<p>
				<input type="submit" name="submit" id="submit">
			</p>
		</fieldset>
	</form>
</main>