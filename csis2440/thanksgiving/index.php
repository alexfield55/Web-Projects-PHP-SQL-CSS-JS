<?php
	if($_SERVER['HTTP_HOST'] == "localhost")
	{
		define("HOST", "localhost");
		define("USER", "root");
		define("PASS", "1550");
		define("DATABASE", "holiday");
	}
	else
	{
		define("HOST", "localhost");
		define("USER", "alexfiel_alexfie");
		define("PASS", "DvCq-=wk7fb0");
		define("DATABASE", "alexfiel_holiday");	
	}

	$link = mysqli_connect(HOST, USER, PASS, DATABASE);

?>				
<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>Thanksgiving!</title>
			<link href="css/style.css" rel="stylesheet" type="text/css">
			<script src="js/myscript.js"></script>
		</head>
		<body>
		<div>
		<h1>Thanksgiving Food List!</h1>
		<?php
			$tableOpen="<table><tr><th>Picture</th><th>Food</th><th>Rating</th><th>Cook</th><tr>";
			
			$query = "SELECT * FROM recipes";
			$results = mysqli_query($link, $query);
			$tableGuts="";
			while($row = mysqli_fetch_assoc($results))
			{
				$tableGuts.="<tr><td><img src='img/".$row['rating'].".jpg'><td>".$row['food']."</td><td>".$row['rating']."</td><td>".$row['cook']."</td></tr>";
			}
			$tableClose = "</table>";
			echo $tableOpen.$tableGuts.$tableClose;
		
		?>
		</div>
		</body>
	</html>
	
