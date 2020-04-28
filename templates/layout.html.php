<?php 
	$sql = "SELECT 	categoryID, categoryName
			FROM 	Category";

	$stmt = $pdo->prepare($sql);

	$rows = $db->executeSQL($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$title;?> - Sports Warehouse</title>
	<?php if(isset($_SESSION["theme"])): ?>
		<link rel="stylesheet" type="text/css" href="css/<?=$_SESSION["theme"];?>">
	<?php else: ?>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	<?php endif; ?>
	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="imgs/apple-touch-icon.png">
	<link rel="icon" type="imgs/png" sizes="32x32" href="imgs/favicon-32x32.png">
	<link rel="icon" type="imgs/png" sizes="16x16" href="imgs/favicon-16x16.png">
	<link rel="manifest" href="imgs/site.webmanifest">
	<!-- FONTS -->
	<!-- Open Sans -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400&display=swap" rel="stylesheet">

	<!-- Font Awesome (Icons) -->
	<script src="https://kit.fontawesome.com/372f0590ad.js"></script>

	<!-- jQuery -->
	<script
	  src="https://code.jquery.com/jquery-3.4.1.min.js"
	  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	  crossorigin="anonymous"></script>

	<!-- Slideshow Thing (https://bxslider.com) -->
	<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">

	<script>
	  $(document).ready(function(){
	    $('.bxslider').bxSlider({
	    	mode: 'fade', // 'horizontal', 'vertical', 'fade'
	    	speed: 250, // Int
	    	pager: true, // Boolean (Dots @ Bottom Of Slide)
	    	randomStart: true, // Boolean
	    	auto: true, // Boolean
	    	stopAutoOnClick: false, // Boolean
	    	autoHover: true, // Boolean
	    	pause: 15000 // Int (Milliseconds)
	    });
	  });
	</script>

</head>
<body>
	<header id="main-header">

		<?php include "topBanner.html.php" ?>

		<div class="wrapper">

			<?php include "logoSearch.html.php" ?>

		</div>
	</header>

	<div class="wrapper">
		<?=$output;?>
	</div>
	
	<footer id="main-footer">
		<div class="mobile">
			<h1>Site Navigation</h1>
			<nav class="footer-nav">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="#">About SW</a></li>
					<li><a href="contactUs.php">Contact Us</a></li>
					<li><a href="allItems.php">View Products</a></li>
					<li><a href="#">Privacy Policy</a></li>
				</ul>
			</nav>

			<h1>Contact Sports Warehouse</h1>
			<div class="social">
				<div>
					<a href="#" class="fab fa-facebook-f"></a>
					<p>Facebook</p>
				</div>
				<div>
					<a href="#" class="fab fa-twitter"></a>
					<p>Twitter</p>
				</div>
				<div>
					<a href="#" class="fas fa-paper-plane"></a>
					<p>Other</p>
				</div>
			</div>
		</div>
		<div class="desktop">
			<div class="wrapper">
				<div>
					<h1>Site Navigation</h1>
					<nav class="footer-nav">
						<ul>
							<li><a href="index.php">Home</a></li>
							<li><a href="#">About SW</a></li>
							<li><a href="contactUs.php">Contact Us</a></li>
							<li><a href="allItems.php">View Products</a></li>
							<li><a href="#">Privacy Policy</a></li>
						</ul>
					</nav>
				</div>

				<div id="footer-categories">
					<h1>Product Categories</h1>
					<nav id="footer-categories-nav">
						<ul>
							<?php 
							foreach($rows as $data):
								$id = $data["categoryID"];
								$name = $data["categoryName"];
							?>
								<li><a href="categories.php?cat=<?=$id;?>"><?=$name;?></a></li>
							<?php endforeach; ?>
						</ul>
					</nav>
				</div>

				<div>
					<h1>Contact Sports Warehouse</h1>
					<div class="social">
						<div>
							<a href="#" class="fab fa-facebook-f"></a>
							<p>Facebook</p>
						</div>
						<div>
							<a href="#" class="fab fa-twitter"></a>
							<p>Twitter</p>
						</div>
						<div>
							<a href="#" class="fas fa-paper-plane"></a>
							<p>Other</p>
						</div>
					</div>
				</div>
			</div>
		</div>

	</footer>

		<div id="copyright">
			<p>&copy; Copyright 2020 Sports Warehouse.</p>
			<p>All rights reserved.</p>
			<p>Website made by Zane Frendin</p>
			<p style="display:block;">Note: This website is not a real sporting goods store & is for demonstration purposes only</p>
		</div>


	<script>
		document.addEventListener("DOMContentLoaded", () => {

			// Get the toggle button and the menu
			let toggle = document.getElementById("menu-toggle");
			let menu = document.getElementById("mobile-header-nav");

			// Make sure menu and toggle button exist
			if (toggle && menu) {

				// Add click event listener to toggle button
				toggle.addEventListener("click", (event) => {

					// Stop hyperlink navigation
					event.preventDefault();

					// Toggle (add/remove) CSS class on the menu
					menu.classList.toggle("hidden");

				});
			}
		});
	</script>

	<script src="js/app.js"></script>
</body>
</html>