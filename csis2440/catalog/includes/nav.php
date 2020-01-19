<?php

		
		echo '<nav><ul>';
		echo '<li><a href="index.php">Home</a></li>';
		if(isset($_SESSION['user']))
		echo '<li><a href="user.php">Account Info</a></li>';
		if(!isset($_SESSION['user']))
		echo '<li><a href="create-account.php">Create Account</a></li>';
		echo '<li><a href="catalog.php">Catalog</a></li>';
		echo '<li><a href="cart.php">Cart</a></li>';
		echo '<li><a href="logout.php">Log Out</a></li>';
			
		echo '</ul></nav>';
?>