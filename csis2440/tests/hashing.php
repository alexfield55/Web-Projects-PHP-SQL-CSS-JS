<?php

	if($_SERVER['HTTP_HOST'] == "localhost")
		{
			define("HOST", "localhost");
			define("USER", "root");
			define("PASS", "1550");
			define("DATABASE", "user_hash");
		}
	else
	{
		define("HOST", "localhost");
		define("USER", "alexfiel_alexfie");
		define("PASS", "DvCq-=wk7fb0");
		define("DATABASE", "alexfiel_users");	
	}

	$link = mysqli_connect(HOST, USER, PASS, DATABASE);
	$insert = 'INSERT INTO USERS(USERNAME, PASSWORD) VALUE ("' . hash("sha256", "beavis") .'","' . hash("sha256","password").'");';
	mysqli_query($link, $insert);


?>

			
<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>Insecure Password Test</title>
			<! <link href="css/style.css" rel="stylesheet" type="text/css">
			<script src="js/myscript.js"></script>
		</head>
		<body>
			<div>
			<?php 									
				$sql = "SELECT * FROM users;"; //sql query
				$results = mysqli_query($link, $sql); //grabs table users
			
				
				while($records = mysqli_fetch_array($results, MYSQLI_ASSOC)) //loops users and takes fields "username" and "password" into associative array
				{
					$userPassPairs[$records['USERNAME']]=$records['PASSWORD']; // makes new associative array with usernames and passwords
				}
			
				if(empty($_POST['submit'])) //checks if submit button is pressed
				{
					echo '<h1>SUPER SECRET GOVERNMENT LOGIN</h1>';
					displayForm();
					$img = 0;
				}
				
				if(!empty($_POST['submit'])) //if submit button is pressed runs checks, if $ec=1 passed through the checks, anything greater than 1 and it has failed at some point, so basically just incrementing the shit out of $ec when wrong things happen, and resetting to 1 everytime a check is passed
				{
					$user="";
					$pass="";
					$ec=0;
					
					if(!empty($_POST['user'])) //check for user post variable
					{
						$user = $_POST['user'];
						$ec=1;
					}
					else $ec+=2;
					
					if(!empty($_POST['pass'])) //check for password post variable
					{
						$pass = $_POST['pass'];
						$ec=1;
					}
					else $ec+=2;	
						
					foreach ($userPassPairs as $k => $v) //compare associative array of userPassPairs agains post variables for match
					{
						if($k==hash("sha256",$user) && $v==hash("sha256",$pass))
						{
							$ec = 1;
							break;
						}
						else $ec+=2;	
					}
					
					if($ec==1)
					{
						echo "<h1 class='granted'>ACCESS GRANTED</h1>";	
						$img = 1;
					}
					if($ec>1)
					{	
						echo "<h1 class='denied'>ACCESS DENIED</h1>";
						echo "<script>playing();</script>";
						displayForm();
						$img = 2;
						
					}
				}
				
				function displayForm()
				{
					echo '<form action="hashing.php" method="post">';
					echo 	'<input type="text" name="user" placeholder="User Name">';
					echo 	'<input type="text" name="pass" placeholder="Password">';
					echo 	'<input type="reset">';
					echo 	'<input type="submit" name="submit">';
					echo '</form>';
				}
				
			?>	
			<img class="img" alt="img" src="img/<?php echo $img;?>.jpg">
			</div>
		</body>
	</html>
	
