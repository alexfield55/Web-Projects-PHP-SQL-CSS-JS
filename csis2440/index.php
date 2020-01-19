<?php 

	$url = substr($_SERVER['PHP_SELF'],22);
		$fileNames = scandir('.');
		
		
		echo "<h1>This is Alex Fields's PHP Home Page</h1>";
		echo "<p>Soon it will have many PHP projects</p>";
	
		
		echo '<nav><ul>';
		
			//starts at two to get rid of . and .. directories
			for($i=2;$i<sizeof($fileNames);$i++) 
			{
					echo '<li><a href="'; //add active and change index to home
					echo $fileNames[$i];
					echo '">';
					echo $fileNames[$i];
					echo '</a></li>';
			}
			
		echo '</ul></nav>';	
		






?>