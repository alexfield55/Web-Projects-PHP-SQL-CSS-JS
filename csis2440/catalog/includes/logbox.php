<?php

	echo "<div class=logbox>";
	echo "<p>";
	
	if(isset($_SESSION['user']))
	{
		
		
		echo $_SESSION['user'];
		echo " you are logged in!</p>";
		echo "<form action='logout.php' method='post'>";
		echo "<input type='submit' value='Log Out'>";
		echo "</form>";
		
	}
	
	else
	{
		echo "Guest you are NOT logged in!</p>";
		echo "<form action='index.php' method='post'>";
		echo "<input type='submit' value='Log In'>";
		echo '<input type="submit" formaction="create-account.php" name="create" value="Create Account">';
		echo "</form>";
		
	}
	
	echo "</div>";
?>