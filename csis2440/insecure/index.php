<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>Insecure Password Test</title>
			<link href="css/style.css" rel="stylesheet" type="text/css">
			<script src="js/myscript.js"></script>
		</head>
		<body>
			<div>
			<?php 	
			
				$fn = 'includes/users.txt'; //store filepath as varialbe
				$fs = fopen($fn, 'r'); //use opening function param filepath and r means read
				$fileText = fread($fs, filesize($fn)); //store text from file using stream and size of file
				$words = explode('||>><<||', $fileText); //intilize and assign array by delimiter and file text
				fclose($fs); // close file stream
				
				foreach ($words as $w)
				{
					$temp = explode(',',$w);
					$userPassPairs[$temp[0]]=$temp[1];
				}
				
				if(empty($_POST['submit']))
				{
					echo '<h1>SUPER SECRET GOVERNMENT LOGIN</h1>';
					echo '<form action="index.php" method="post">';
					echo 	'<input type="text" name="user" placeholder="User Name">';
					echo 	'<input type="text" name="pass" placeholder="Password">';
					echo 	'<input type="reset">';
					echo 	'<input type="submit" name="submit">';
					echo '</form>';
					$img = 0;
				}
				
				if(!empty($_POST['submit']))
				{
					$user="";
					$pass="";
					$ec=0;
					
					if(!empty($_POST['user']))
					{
						$user = $_POST['user'];
						$ec=1;
					}
					else $ec+=2;
					
					if(!empty($_POST['pass']))
					{
						$pass = $_POST['pass'];
						$ec=1;
					}
					else $ec+=2;
										
					foreach ($userPassPairs as $k => $v)
					{
						if($k==$user && $v==$pass)
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
						echo '<form action="index.php" method="post">';
						echo 	'<input type="text" name="user" placeholder="User Name">';
						echo 	'<input type="text" name="pass" placeholder="Password">';
						echo 	'<input type="reset">';
						echo 	'<input type="submit" name="submit">';
						echo '</form>';
						$img = 2;
						
					}
				}
				
			?>	
			<img class="img" alt="img" src="img/<?php echo $img;?>.jpg">
			</div>
		</body>
	</html>
	
