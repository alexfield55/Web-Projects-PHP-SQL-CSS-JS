<?php
	include('includes/functions.php');
	include('includes/database.php');
?>

<!DOCTYPE html>
	<html lang="en">
		<?php include('includes/head.php'); ?>
		<body>
			<?php 
				include('includes/nav.php');
			?>			
			<h1>Palindromes Database</h1>
			<div class="dbdisplay">
			<?php
				$sql = "SELECT * FROM PALINDROME;";
				$result =  mysqli_query($link,$sql);
				
				while($rows = mysqli_fetch_assoc($result))
				{
					echo "<p>".$rows['phrase']."</p>";	
				}
			?>
			</div>
		</body>
	</html>
	
