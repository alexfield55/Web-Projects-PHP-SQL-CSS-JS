<?php

	if($_SERVER['HTTP_HOST'] == "localhost")
		{
			define("HOST", "localhost");
			define("USER", "root");
			define("PASS", "1550");
			define("DATABASE", "secureusers");
		}
	else
	{
		define("HOST", "localhost");
		define("USER", "alexfiel_alexfie");
		define("PASS", "DvCq-=wk7fb0");
		define("DATABASE", "alexfiel_secureusers");	
	}

	$link = mysqli_connect(HOST, USER, PASS, DATABASE);
	$main = "main";
	
	if(!empty($_POST['submit'])) //if submit button is pressed runs checks
	{
		$user="";
		$pass="";
		$code="";
		$verified=false;
		
		if(!empty($_POST['user'])&&!empty($_POST['pass'])&&!empty($_POST['code'])&&!empty($_POST['code'])) //if each variable is set run additional checks
		{
			$user = $_POST['user'];
			$pass = SaltAndHash($_POST['pass']);
			$code = $_POST['code'];
			
			$query = "SELECT username FROM users WHERE	username='$user' and password='$pass'";
			$result = mysqli_query($link,$query);
			
			$query1 = "SELECT * FROM code;";
	
			$result1 = mysqli_query($link,$query1);
			$row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
			
			if($result->num_rows && $code==$row['code']) //if query returns a result it will have a row, if num rows is bigger than 0 the result is true
				$verified = true;
		}
			
		if($verified)
		{
			$main="g";
			echo "<body class='".$main."'>";
			echo "<div>";
			echo "<h1 class='granted'>ACCESS GRANTED</h1>";	
			$main="g";
		}
		else
		{	
			$main="d";
			echo "<body class='".$main."'>";
			echo "<div>";
			echo "<h1 class='denied'>ACCESS DENIED</h1>";
			displayForm();	
		}
	}
	
	function SaltAndHash($p)
	{
		$p="salt".$p."salt";
		return hash("sha512",$p);
	}
?>				
<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>More Secure Password Test</title>
			<link href="css/style.css" rel="stylesheet" type="text/css">
		
		</head>
			<?php 
			
				if(empty($_POST['submit'])) //checks if submit button is pressed
				{
					echo "<body class='".$main."'>";
					echo "<div>";
					echo '<h1>SUPER SECRET GOVERNMENT LOGIN</h1>';
					displayForm();
					$img = 0;
				}
				
				function displayForm()
				{
					echo '<form action="?s=true" method="post">';
					echo 	'<input type="text" name="user" placeholder="User Name">';
					echo 	'<input type="password" name="pass" placeholder="Password">';
					echo 	'<input type="password" name="code" placeholder="Code Word">';
					echo 	'<input type="reset">';
					echo 	'<input type="submit" name="submit">';
					echo	'<input type="submit" formaction="create-account.php" name="create" value="Create Account">';
					echo '</form>';
				}
				
			echo "</div>";
			?>
			<script src="js/myscript.js"></script>
		</body>
	</html>
	
