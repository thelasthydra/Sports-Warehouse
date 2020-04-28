<main>
	<h2>Order Has Been Processed</h2>
	<p>Thank You For Your Order, Your Order ID Is: <?=$_SESSION["orderID"];?></p>
	<?php session_destroy(); ?>
	<p>Click <a href="index.php">Here</a> To Return To The Homepage</p>
</main>