		<div id="top-banner">
			<div class="wrapper">

				<a href="#" id="menu-toggle" class="left mobile"><i class="fas fa-bars"></i> Menu</a>

				<nav class="left desktop" id="header-nav">
					<ul>
						<li class="main-nav"><a href="index.php">Home</a></li>
						<li class="main-nav"><a href="#">About SW</a></li>
						<li class="main-nav"><a href="contactUs.php">Contact Us</a></li>
						<li class="main-nav"><a href="allItems.php">View Products</a></li>
					</ul>
				</nav>

				<div class="right">
					<?php if(isset($_SESSION["username"])): ?>
						<a href="adminPage.php" class="desktop" id="desktop-login"><i class="fas fa-unlock"></i>Admin Panel</a>
					<?php else: ?>
						<a href="login.php" class="desktop" id="desktop-login"><i class="fas fa-lock"></i>Login</a>
					<?php endif; ?>
					<a href="cartItems.php" id="view-cart"><i class="fas fa-shopping-cart"></i>View Cart</a>
					<?php if(isset($_SESSION["cart"])): ?>
						<a href="cartItems.php" id="cart-items"><?=$_SESSION["cart"]->count();?> Items</a>
					<?php else: ?>
						<a href="cartItems.php" id="cart-items">0 Items</a>
					<?php endif; ?>
				</div>

			</div>
		</div>

		<nav id="mobile-header-nav" class="hidden mobile">
			<div class="wrapper">
				<ul>
					<?php if(isset($_SESSION["username"])): ?>
						<li><a href="adminPage.php"><i class="fas fa-unlock"></i>Admin Panel</a></li>
					<?php else: ?>
						<li><a href="login.php"><i class="fas fa-lock"></i>Login</a></li>
					<?php endif; ?>	
					<li class="drop-down"><a href="index.php"><i class="far fa-circle"></i>Home</a></li>
					<li class="drop-down"><a href="#"><i class="far fa-circle"></i>About SW</a></li>
					<li class="drop-down"><a href="contactUs.php"><i class="far fa-circle"></i>Contact Us</a></li>
					<li class="drop-down"><a href="allItems.php"><i class="far fa-circle"></i>View Products</a></li>
				</ul>
			</div>
		</nav>