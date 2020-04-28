<main id="singleItem">
	<?php 
		require_once "classes/DBImage.php";
		$img = new DBImage();
		foreach($rows as $data):
			$photo = $img->checkPhoto($data["photo"]);
			$itemID = $data["itemID"];
			$itemName = $data["itemName"];
			$price = "$" . sprintf("%01.2f", $data["price"]);
			$desc = $data["description"];
	?>
	<h2><?=$itemName;?></h2>
	<div>
		<div class="left">
			<img src="<?=$photo;?>" alt="<?=$photo;?> Not Found" title="<?=$itemName;?>">
		</div>
		<div class="right">
			<?php 
				$onSale = ($data["onSale"] == 1) ? true : false;
				if($onSale):
					$salePrice = "$" . sprintf("%01.2f", $data["salePrice"]);
			?>	
					<div class="price">
						<p class="discounted">
							<?=$salePrice;?>
						</p>
						<p class="normal">
							was <span class="strike"><?=$price;?></span>
						</p>
					</div>
			<?php 
				else:
			?>
					<p class="price">
						<?=$price;?>
					</p>

			<?php endif; ?>
		  			<p>
		  				<?=$desc;?>
		  			</p>
		  			<form action="addToCart.php" method="post" class="form" id="addToCartForm"> 
		  				<input type="hidden" name="id" value="<?=$itemID;?>">
		  				<input type="hidden" name="name" value="<?=$itemName;?>">
		  				<!-- Checks If Item Is On Sale -->
		  				<?php if ($onSale): ?>
		  					<!-- If Item Is On Sale Display This -->
		  					<input type="hidden" name="price" value="<?=sprintf("%01.2f", $data["salePrice"]);?>">
		  				<?php else: ?>
		  					<!-- If Item Is Not On Sale Use This -->
		  					<input type="hidden" name="price" value="<?=sprintf("%01.2f", $data["price"]);?>">
		  				<?php endif; ?>
		  				<input type="hidden" name="photo" value="<?=$photo;?>">
		  				<p class="left" id="qty">
		  					<label for="qty">Qty: </label>
		  					<input type="number" name="qty" class="input xs" value="1" min="1">
		  				</p>
		  				<input type="submit" name="submit" value="Buy!">
		  			</form>

		  	<?php  
				  endforeach; 
			?>
		</div>
		<p class="clearFix"></p>
	</div>
</main>