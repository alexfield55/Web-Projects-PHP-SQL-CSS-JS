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
?>				
<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>More Secure Password Test</title>
			<link href="css/style.css" rel="stylesheet" type="text/css">
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
				</script>
		
				<script src="js/myscript.js"></script>
		
			</head>
		<body class="main" id="main">
			<?php 
				$main = "main";
				$user="";
				$pass="";
				$vpass="";
				$code="";
				$ec=0;
				$msg;
			
				if(empty($_POST['submit'])) //checks if submit button is pressed
				{
					echo "<div>";
					echo '<h1>CREATE ACCOUNT</h1>';
					displayForm($user,$pass,$vpass,$code,false);
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
					if(!empty($_POST['code']))
					{
						$code = $_POST['code'];
					}
					else 
					{
						$ec++;
						$msg[]="Please Enter Codeword";
					}
					
					$query = "SELECT username FROM users WHERE	username='$user';";
					$result = mysqli_query($link,$query);
					if($result->num_rows)
					{
						$ec++;
						$msg[]="Username already Exists, choose another";
					}
					if($vpass!=$pass)
					{
						$ec++;
						$msg[]="Passwords don't match";
					}

					$query = "SELECT * from code";
					$result = mysqli_query($link,$query);
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					if($code!=$row['code'] && !empty($_POST['code']))
					{
						$ec++;
						$msg[]="Code is wrong";
					}
				
						
					if($ec!=0)
					{
						$main="d";
						echo "<div>";
						echo "<h1 class='denied'>TRY AGAIN</h1>";	
						displayForm($user,$pass,$vpass,$code,$_GET['s']);
						foreach($msg as $m)
						{
							echo "<h1>".$m."</h1>";
						}
					}
					else
					{	
						$query = "INSERT INTO users(username,password) values('$user','".SaltAndHash($pass)."');";
						mysqli_query($link,$query);
						$main="g";
						echo "<div>";
						echo "<h1 class='granted'>ACCOUNT CREATED</h1>";
						echo "<a href='index.php'><button>Sign In</button></a>";	
					}
				}
				
				function SaltAndHash($p)
				{
					$p="salt".$p."salt";
					return hash("sha512",$p);
				}
				
				function displayForm($u,$p,$v,$c,$g)
				{
					if(!$g)
						$d="disabled";
					echo '<form action="?s=true" method="post">';
					echo 	'<input type="text" name="user" value="'.$u.'" placeholder="User Name">';
					echo 	'<input type="password" id="pass" name="pass" oninput="validate(this);" value="'.$p.'" placeholder="Password">';
					echo 	'<input type="password" id="vpass" name="vpass" oninput="validate(this);" value="'.$v.'" placeholder="Verify Password">';
					echo 	'<input type="password" name="code" value="'.$c.'" placeholder="Code Word">';
					echo 	'<input type="reset">';
					echo 	'<input type="submit" id="submit" name="submit" '.$d.'>';
					echo '</form>';
					echo '<h1 id="v">Please Enter Your Information</h1>';
				}
				
				echo "</div>";
			?>
			
	
		</body>
	</html>
	
