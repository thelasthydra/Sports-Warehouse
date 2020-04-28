			<h1 id="logo-container">
				<a href="index.php"><img src="imgs/logo.gif" alt="Sports Warehouse" id="main-logo"></a>
			</h1>

			<form id="searchForm" method="post" action="search.php">
				<input type="text" name="search" id="search" placeholder="Search Products">
				<button type="submit" name="btnSearch" id="btnSearch"><i class="fas fa-search"></i></button>
			</form>
			
			<nav class="categories-nav">
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