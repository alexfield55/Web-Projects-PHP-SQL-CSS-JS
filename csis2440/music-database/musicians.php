<?php include('includes/functions.php');?>
<!doctype html>
	<html lang="en">
	<?php include('includes/head.php'); ?>
		<body onload="playing();">
			<?php 
				buildNav();
				echo "<h1>Artist Database</h1>";
				displayTable(createMusicPeopleArray());
			?>
		</body>
	</html>

