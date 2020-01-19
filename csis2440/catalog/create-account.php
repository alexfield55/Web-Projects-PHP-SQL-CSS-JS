<?php

	session_start();
	include("includes/db.php");
?>				
<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>Catalog</title>
			<link href="css/style.css" rel="stylesheet" type="text/css">
			<meta charset="UTF-8"/>
		</head>
			<?php 
			echo "<div class='navbar'>";
				include("includes/nav.php");
				include("includes/logbox.php");
			echo "</div>";
			echo "<div class='mainwrap'>";
			echo "<div class='login'>";
				$main = "main";
				$user="";
				$pass="";
				$vpass="";
				$ec=0;
				$msg;
			
				if(empty($_POST['submit'])) //checks if submit button is pressed
				{
					echo "<body class='".$main."'>";
					echo "<div>";
					echo '<h1>Create account for Acme Store</h1>';
					displayForm($user,$pass,$vpass,false);
				}
							
				if(!empty($_POST['submit'])) //if submit button is pressed runs checks
				{
					
					if(!empty($_POST['user']))
					{
						$user = $_POST['user']; 
					}
					else 
					{
						$ec++;
						$msg[]="Please Enter Username";
					}
					if(!empty($_POST['pass']))
					{
						$pass = $_POST['pass'];
					}
					else 
					{
						$ec++;
						$msg[]= "Please Enter Password";
					}
					if(!empty($_POST['vpass']))
					{
						$vpass = $_POST['vpass'];
					}
					else
					{
						$ec++;
						$msg[]="Please Enter Password Verification";
					}
					
					$query = "SELECT username FROM user WHERE username='$user';";
					$result = mysqli_query($link,$query);
					if($result->num_rows>0)
					{
						$ec++;
						$msg[]="Username already Exists, choose another";
					}
					if($vpass!=$pass)
					{
						$ec++;
						$msg[]="Passwords don't match";
					}
						
					if($ec!=0)
					{
						$main="d";
						echo "<body class='".$main."'>";
						echo "<div>";
						echo "<h1 class='denied'>TRY AGAIN</h1>";	
						displayForm($user,$pass,$vpass,$_GET['s']);
						foreach($msg as $m)
						{
							echo "<h1>".$m."</h1>";
						}
					}
					else
					{	
						$query = "INSERT INTO user(username,password) values('$user','".SaltAndHash($pass)."');";
						mysqli_query($link,$query);
						$main="g";
						echo "<body class='".$main."'>";
						echo "<div>";
						echo "<h1 class='granted'>Account Creation Successful!</h1>";	
						echo "<p>Please <a href='index.php'>Sign In</a> to Create User Account!</p>";	
					}
				}
				
				function SaltAndHash($p)
				{
					$p="salt".$p."salt";
					return hash("sha512",$p);
				}
				
				function displayForm($u,$p,$v,$g)
				{
					if(!$g)
						$d="disabled";
					else $d="";
					echo '<form action="?s=true" method="post">';
					echo 	'<input type="text"  id="user" name="user" value="'.$u.'" placeholder="User Name" oninput="validate(this);">';
					echo 	'<input type="password" id="pass" name="pass" oninput="validate(this);" value="'.$p.'" placeholder="Password">';
					echo 	'<input type="password" id="vpass" name="vpass" oninput="validate(this);" value="'.$v.'" placeholder="Verify Password">';
					echo 	'<input type="reset">';
					echo 	'<input type="submit" id="submit" name="submit" '.$d.'>';
					echo '</form>';
					echo '<p id="v">Please Enter Your Information</p>';
					echo '<p id="w">Password Must Be 8 characters long and have 1 Number</p>';
					echo '<p id="x">Username must be less than 10 characters long</p>';
				}
				
				echo "</div>";
				echo "</div>";
				echo "</div>";
			?>
			<script src="js/myscript.js"></script>
		</body>
	</html>
	
