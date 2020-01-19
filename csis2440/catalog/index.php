<?php
	session_start();
	include("includes/db.php");
	

	$main = "main";
	$verified=false;

	
	function SaltAndHash($p)
	{
		$p="salt".$p."salt";
		return hash("sha512",$p);
	}
	
	if(isset($_POST['submit'])) //if submit button is pressed runs checks
		{
			$user="";
			$pass="";
		
			
			if(!empty($_POST['user'])&&!empty($_POST['pass'])) //if each variable is set run additional checks
			{
				$user = $_POST['user'];
				$pass = SaltAndHash($_POST['pass']);
				
				$query = "SELECT username FROM user WHERE	username='$user' and password='$pass'";
				$result = mysqli_query($link,$query);
				
				if($result->num_rows)
				{
					$verified = true;
					$_SESSION['user']=$user;
				}
				
			}
				
		
			
		}
?>				
<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>Catalog</title>
			<link href="css/style.css" rel="stylesheet" type="text/css">
			<meta charset="UTF-8"/>
		</head>
			<body>
			<div>
			<?php 
			echo "<div class='navbar'>";
				include("includes/nav.php");
				include("includes/logbox.php");
			echo "</div>";
			echo "<div class='mainwrap'>";
				
				echo "<div class=login>";
			
				if(!isset($_SESSION['user'])&&!isset($_GET['s']))
				{
					echo '<h1>Catalog Login</h1>';
						echo "<p>Welcome to ACME products. Are you an animal trying to kill another animal? Do you have a hobby of doing extreme pranks on your friends? Can you pass an FBI background check? If you answered 'MAYBE!' to some of these questions, then we have the products for you. Please see below to sign in or create an account!</p>";
					displayForm();
					echo "<img id='thatsall' alt='thatsall' src='img/dynamite4.png'>";
				}
				if ($verified==false&&isset($_GET['s']))
				{
					echo '<h1>Catalog Login</h1>';
						echo "<p>Welcome to ACME products. Are you an animal trying to kill another animal? Do you have a hobby of doing extreme pranks on your friends? Can you pass an FBI background check? If you answered 'MAYBE!' to some of these questions, then we have the products for you. Please see below to sign in or create an account!</p>";
					echo '<p>Username or Password not identified, please try again</p>';
					displayForm();
					echo "<img id='thatsall' alt='thatsall' src='img/dynamite4.png'>";
				}
				if(isset($_SESSION['user']))
				{
					echo '<h1>Welcome to the Acme Store!</h1>';
						echo "<p>Welcome to ACME products. Are you an animal trying to kill another animal? Do you have a hobby of doing extreme pranks on your friends? Can you pass an FBI background check? If you answered 'MAYBE!' to some of these questions, then we have the products for you. Please see below to shop or update the shipping information in your account!</p>";
					echo '<p>Please <a href="user.php">Update/Verify</a> your account information, ';
					echo 'or continue to <a href="catalog.php">shopping</a>!</p>';
					echo "<img id='thatsall' alt='thatsall' src='img/logos.jpg'>";
					
					
				}
				echo "</div>";
			
				
					
			
				
				function displayForm()
				{
					echo '<form action="?s=true" method="post">';
					echo 	'<input type="text" name="user" placeholder="User Name">';
					echo 	'<input type="password" name="pass" placeholder="Password">';
					echo 	'<input type="reset">';
					echo 	'<input type="submit" name="submit">';
					echo	'<input type="submit" formaction="create-account.php" name="create" value="Create Account">';
					echo '</form>';
				}
				
				echo "</div>";
			?>
			</div>
			<script src="js/myscript.js"></script>
		</body>
	</html>
	
