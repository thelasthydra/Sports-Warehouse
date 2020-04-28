<main id="checkout">
	<h2>Checkout</h2>
	<?php if(isset($_SESSION["cart-message"])): ?>
		<p class="php-error"><?=$_SESSION["cart-message"];?></p>
	<?php unset($_SESSION["cart-message"]);
		  endif; ?>
	<form action="checkout.php" method="post" class="form">
		<fieldset>
			<legend>Shipping Details</legend>
			<p>
				<label for="fname">First Name:</label>
				<input type="text" name="fname" class="input medium" placeholder="John" autofocus required>
			</p>
			<p>
				<label for="lname">Last Name:</label>
				<input type="text" name="lname" class="input medium" placeholder="Smith" required>
			</p>
			<p>
				<label for="address">Address:</label>
				<input type="text" name="address" class="input xl" placeholder="42 Test Street" required>
			</p>
			<p>
				<label for="phone">Contact Number:</label>
				<input type="tel" name="phone" class="input small" placeholder="0404 040 404" pattern="^04(\s?[0-9]{2}\s?)([0-9]{3}\s?[0-9]{3}|[0-9]{2}\s?[0-9]{2}\s?[0-9]{2})$" title="Must Be Valid Australian Phone Number" required>
			</p>
			<p>
				<label>Email:</label>
				<input type="email" name="email" class="input xl" placeholder="john.smith@email.com" pattern="^(\w*|[\.]*)+([@]\w+)+([\.]*|\w*)+$" title="Must Be Valid Email">
			</p>
		</fieldset>
		<fieldset>
			<legend>Payment Details</legend>
			<p>
				<label for="creditCard">Credit Card Number:</label>
				<input type="text" name="creditCard" class="input medium" placeholder="1234 1234 1234 1234" pattern="^\d{4}\s*\d{4}\s*\d{4}\s*\d{4}$" title="Must Be 16 Digits" required>
			</p>
			<p id="expiry">
				<label>Expiry Date:</label>
				<input type="text" name="month" class="input xs" placeholder="MM" minlength="2" maxlength="2" pattern="^(0[1-9]|[0-1][0-2])$" title="Must Be 01-12" required>
				<input type="text" name="year" class="input xs" placeholder="YY" minlength="2" maxlength="2" pattern="^\d{2}$" title="Must Be Last 2 Digits Of Year" required>
			</p>
			<p>
				<label for="cvv">CVV:</label>
				<input type="text" name="cvv" class="input" placeholder="123" pattern="^\d{3}$" title="Must Be 3 Digits" maxlength="3" style="width:3em;text-align:center;">
			</p>
			<p>
				<label for="cardName">Name On Card:</label>
				<input type="text" name="cardName" class="input medium" placeholder="John Smith" required>
			</p>
		</fieldset>
		<p>
			<input type="submit" name="submit" class="submit" value="Pay $<?=number_format($_SESSION["cart"]->calculateTotal(), 2, ".", ",");?>">
		</p>
	</form>
</main>