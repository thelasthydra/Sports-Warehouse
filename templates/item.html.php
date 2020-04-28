<?php 
	
	// Minimum SQL Statement Required
	// "SELECT 	itemID, itemName, photo, price, salePrice, onSale
	// FROM 	Item"

	require_once "classes/DBImage.php";

	foreach($rows as $data):
		$photo = DBImage::checkPhoto($data["photo"]);
		$itemID = $data["itemID"];
		$itemName = $data["itemName"];
		$price = "$" . sprintf("%01.2f", $data["price"]);
?>
		<a href="item.php?id=<?=$itemID;?>"  class="product">
			<article>
				<div class="img-container">
					<img src="<?=$photo;?>" alt="<?=$photo;?> Not Found">
				</div>
<?php
		$onSale = ($data["onSale"] == 1) ? true : false;
		if($onSale):
			$salePrice = "$" . sprintf("%01.2f", $data["salePrice"]);
?>
				<p class="price mobile">
					<span class="discounted"><?=$salePrice;?></span><br>
					<span class="normal">was <span class="strike"><?=$price;?></span></span>
				</p>
				<p class="price desktop">
					<span class="discounted"><?=$salePrice;?></span>
					<span class="normal">was <span class="strike"><?=$price;?></span></span>
				</p>
				<p class="name"><?=$itemName;?></p>
<?php 
	else: 
?>
				<p class="price">
					<?=$price;?>
				</p>
				<p class="name"><?=$itemName;?></p>
<?php 
	endif; ?>

		</article>
	</a>

<?php
	endforeach;
?>