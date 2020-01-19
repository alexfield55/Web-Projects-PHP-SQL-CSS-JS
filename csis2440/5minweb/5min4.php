<!doctype html>
	<html lang="en">
		<head><title>5 min 4</title></head>
		<body>
			<ul>
				<?php
					for($i=0;$i<3;$i++)
					{
						switch($i)
						{
							case 0: $temp="home"; break;
							case 1: $temp="about"; break;
							case 2: $temp="contact"; break;
						}
						echo "<li><a href='$temp.php'>$temp</a></li>";
					}			
				?>
			</ul>
		</body>
	<html>