<h2>Admin Page - <?=$_SESSION["username"];?></h2>

<section id="adminPage">
	<?php if(isset($_SESSION["message"])): ?>
		<p><?=$_SESSION["message"];?></p>
	<?php unset($_SESSION["message"]);
		  endif; ?>

	<h3>Things This Page Needs To Do</h3>
	<ul>
		<li class="done"><a href="logout.php">Logout</a></li>
		<li class="done"><a href="?type=changePassword">Change Password</a></li>
		<li class="done"><a href="?type=createUser">Create New User</a></li>
		<li class="done"><a href="?type=deleteUser">Delete User</a></li>
		<li class="done"><a href="?type=category">Add Categories</a></li>
		<li class="done"><a href="?type=category">Edit Categories</a></li>
		<li class="done"><a href="?type=addItem">Add Item</a></li>
		<li class="done"><a href="?type=editItem">Edit Items</a></li>
		<li class="done"><a href="?type=changeTheme">Change UI</a></li>
	</ul>
	
</section>