<?php include('includes/functions.php');?>
<!doctype html>
	<html lang="en">
		<?php include('includes/head.php'); ?>
		<body onload="playing();">
			<?php 
				buildNav();
				echo "<h1>Music Database</h1>";
				displayTable(createAlbumArray());
			?>
		</body>
	</html>
	