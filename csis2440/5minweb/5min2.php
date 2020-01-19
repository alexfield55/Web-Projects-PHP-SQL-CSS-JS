<!doctype html>
	<html lang="en">
		<head><title>5 min 2</title></head>
		<body>
			<?php
				$a = array("frog","dog","log");
				//$a[]=("frog","dog","log");
				echo "<ul>";
					for($i=0; $i<sizeof($a); $i++) echo "<li>$a[$i]</li>";
				echo "</ul>";
			?>
		</body>
	</html>	