<?php

	if($_SERVER['HTTP_HOST'] == "localhost")
	{
		define("HOST", "localhost");
		define("USER", "root");
		define("PASS", "1550");
		define("DATABASE", "poll");
	}
	else
	{
		define("HOST", "localhost");
		define("USER", "alexfiel_alexfie");
		define("PASS", "DvCq-=wk7fb0");
		define("DATABASE", "alexfiel_poll");	
	}

	$link = mysqli_connect(HOST, USER, PASS, DATABASE);
	
	$query = "SELECT * FROM poll";
	$result = mysqli_query($link, $query);
	
	$choices =[];
	
	while($rows = mysqli_fetch_assoc($result))
	{
		$choices[]=$rows['band'];
	}
	
	if($_GET['s']=true && isset($_POST['choice']))
	{
		$band = $_POST['choice'];
		$query = 'UPDATE poll SET votes = votes + 1 WHERE band = "'.$band.'";';
		mysqli_query($link,$query);
	}
	
?>				
<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>Web-Poll</title>
			<link href="https://fonts.googleapis.com/css?family=Creepster" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css?family=Metal%20Mania" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css?family=Nosifer" rel="stylesheet">
			<link href="css/style.css" rel="stylesheet" type="text/css">
		</head>
		<body>
			<div>
				<h1>THE BIG 4!!!!</h1>
			<?php
				if($_GET['s'])
				{
					displayResults($choices,$link);
				}
				else
					displayPoll($choices);
			?>
		<!--<script>
			if ( window.history.replaceState )
				{
					window.history.replaceState( null, null, window.location.href );
				}
		</script> -->
			</div>
		</body>
	</html>
	
<?php

	function displayPoll($choices)
	{
		echo '<h2>VOTE YOUR FAVORITE</h2>';
		echo '<form id="form" action="?s=true" method="post">';
		foreach($choices as $c)
		{
			echo '<input type="radio" name="choice" value="'.$c.'">'.$c.'<br>';
		}
		echo '<input type="submit">';
		echo '</form>';
	}
	
			
	function displayResults($choices, $link)
	{
		echo '<h2>Thanks for your vote!</h2>';
		
		$query = 'select sum(votes) from poll;';
		$results = mysqli_query($link,$query);
		while($rows = mysqli_fetch_assoc($results))
			$numVotes=$rows['sum(votes)'];
	
		foreach($choices as $c)
		{
			$query = 'SELECT votes FROM poll WHERE band = "'.$c.'";';
			$results = mysqli_query($link,$query);
			while($rows = mysqli_fetch_assoc($results))
			$votes = $rows['votes'];

			echo '<p>'.$c.' got ';
			if($votes>0)
				printf ("%.2f", $votes/$numVotes*100);
			else echo '0.00';
			echo ' % of the votes</p>';

		}
	}
?>
	
