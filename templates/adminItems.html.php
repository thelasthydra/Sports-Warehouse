<?php 
	$sql = "SELECT itemID, itemName, price, salePrice, onSale, featured, categoryName
			FROM 	Item i, Category c
			WHERE   i.categoryID = c.categoryID";
	$stmt = $pdo->prepare($sql);
	$rows = $db->executeSQL($stmt);
?>

<main class="mobile">
	<h2>Items</h2>
	<p>To View This Page Please Use A Dekstop Browser</p>
</main>
<main class="desktop">
	<h2>Items</h2>
	<table id="adminItems">
		<thead>
			<tr>
				<th>Item Name</th>
				<th>Price</th>
				<th>Sale Price</th>
				<th>On Sale</th>
				<th>Featured</th>
				<th>Category</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($rows as $data): ?>
				<?php $onSale = ($data["onSale"]) ? "Yes" : "No"; ?>
				<?php $featured = ($data["featured"]) ? "Yes" : "No"; ?>
				<tr>
					<td class="name"><?=$data["itemName"];?></td>
					<td class="price">$<?=number_format($data["price"], 2, ".", ",");?></td>
					<td class="salePrice">$<?=number_format($data["salePrice"], 2, ".", ",");?></td>
					<td class="onSale"><?=$onSale;?></td>
					<td class="featured"><?=$featured;?></td>
					<td class="category"><?=$data["categoryName"];?></td>
					<td class="edit"><a href="editItem.php?item=<?=$data["itemID"];?>"><i class="far fa-edit"></i></a></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<form class="form">
		<input type="submit" name="back" class="clear back" value="&lt;  Back">
	</form>
</main>