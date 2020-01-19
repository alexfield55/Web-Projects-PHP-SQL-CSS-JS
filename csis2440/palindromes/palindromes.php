<?php 
	include('includes/functions.php');
	include('includes/database.php');
	list($searchWord,$palCount,$defaultValue,$ec)=errorCheck();
 ?>
 
<!DOCTYPE html>
	<html lang="en">
		<head>
			<?php include('includes/head.php'); ?>
		</head>
		<body>
			<?php include('includes/nav.php');?>
			<h1><a>World of Palindromes</a></h1>
			<?php createDisplay($searchWord,$palCount,$defaultValue,$ec);?>
		</body>
	</html>
