<h2>Shopping Cart</h2>
<?php if(!isset($_SESSION["cart"]) || $_SESSION["cart"]->count() == 0): ?>
	<!-- No Cart Is Available -->
	<div id="noItems">
		<h3>You Have No Items In Your Shopping Cart</h3>
		<p>To add items to your shopping cart please go to the <a href="index.php">homepage</a> and find items you wish to purchase.</p>
	</div>
<?php elseif(isset($_SESSION["cart"])): 
	  $cart = $_SESSION["cart"]; ?>
	<!-- Cart Is Available -->
	<aside class="right sidebar desktop">
		<h2>Checkout</h2>
		<?php $cartItems = $cart->getItems(); ?>
		<?php foreach ($cartItems as $item): ?>
		<div class="itemDetails ">
			<p><?=$item->getItemName();?> x<?=$item->getQuantity();?></p>
			<p>$<?=number_format($item->getTotalPrice(), 2, ".", ",");?></p>
		</div>
		<?php endforeach; ?>
		<div id="total">
			<p>Total:</p>
			<p>$<?=number_format($cart->calculateTotal(), 2, ".", ",");?></p>
		</div>
		<form action="cartItems.php" method="post">
			<p>
				<input type="submit" name="clear" class="clear" value="Clear Cart">
				<input type="submit" name="submit" class="submit" value="Checkout">
			</p>
		</form>
	</aside>

	<section id="cartItems">
		<?php foreach ($cartItems as $item): ?>
			<div class="cartItem" id="<?=$item->getItemID();?>">
				<div class="img-container">
					<img src="<?=$item->getPhoto();?>" alt="Image Of <?=$item->getItemName();?>" title="<?=$item->getItemName();?>">
				</div>
				<div class="column">
					<p><?=$item->getItemName();?></p>
					<form action="cartItems.php" method="post" class="qty">
						<label for="qty">Qty:</label>
						<input type="hidden" name="itemID" value="<?=$item->getItemID();?>">
						<input type="number" name="qty" value="<?=$item->getQuantity();?>" placeholder="<?=$item->getQuantity();?>">
						<input type="submit" name="update" class="update" value="Update Item">
					</form>
				</div>
				<form action="cartItems.php" method="post" class="removeForm">
					<p>
						<input type="hidden" name="itemID" value="<?=$item->getItemID();?>">
						<input type="submit" name="remove" class="remove" value="Remove">
					</p>
				</form>
			</div>
		<?php endforeach; ?>
		<form action="cartItems.php" method="post">
			<p>
				<input type="submit" name="clear" class="clear" value="Clear Cart">
				<input type="submit" name="submit" class="submit" value="Checkout">
				<label>Total: $<?=number_format($cart->calculateTotal(), 2, ".", ",");?></label>
			</p>
		</form>
		<p class="clearFix"></p>
	</section>

<?php else: ?>
	<!-- Incase Something Else Happens -->
	<?php header("Location: index.php"); ?>
<?php endif; ?>