<?php
	include('includes/functions.php');
	include('includes/database.php');
	list($wValue,$pValue,$defaultValue,$errorCodeVal)=createVariables();
	$allowedPals=10;	
?>

<!DOCTYPE html>
	<html lang="en">
		<?php include('includes/head.php'); ?>
		<body>
			<?php include('includes/nav.php');?>			
			<h1>World of Palindromes</h1>
			<div class="reflection">
			<p>
			Enter your own word on this page to check if it exists in a palindrome. Also choose from a default list of palindromes, or how many palindromes of your own you would like to enter on the next page.
			</p>
			</div>
			<div class="form">
			<form method="post" action="palindromes.php">
				<?php echo displayDefaultCheckbox($defaultValue); ?>
				<?php echo buildSelect($pValue, $allowedPals); ?>
				<input name ="searchWord" type ="text" value="<?php echo $wValue;?>">
				<input type ="reset">
				<input type ="submit">
				<?php echo errorMsg($errorCodeVal)?>
			</form>
			<div>
		</body>
	</html>
	
