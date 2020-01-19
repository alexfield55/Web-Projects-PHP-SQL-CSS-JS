<?php 
if($_SERVER['HTTP_HOST'] == "localhost")
{
	define("HOST", "localhost");
	define("USER", "root");
	define("PASS", "1550");
	define("DATABASE", "stories");
}
else
{
	define("HOST", "localhost");
	define("USER", "alexfiel_alexfie");
	define("PASS", "DvCq-=wk7fb0");
	define("DATABASE", "alexfiel_stories");	
}
	
$link = mysqli_connect(HOST, USER, PASS, DATABASE);
//$poem=[];
$talk="";


?>

<!DOCTYPE html>
	<html lang="en">
		<head>
		<title>POEM MACHINE</title>
		<link href="css/style.css" rel="stylesheet" type="text/css">
		</head>
		
		<body>	
			<div>
			<h1>Diastic Poem Machine</h1>
			<?php if(!isset($_POST['submit'])):?>
			<h2>Choose a story and a seed word(s)</h2>
			<form method="post" action="index.php">
			<input type="radio" name="story" value="100west" required>100 West By 53 North<br>
			<input type="radio" name="story" value="sly_fox" required >The Sly Fox<br>
			<input type="radio" name="story" value="3pigs" required>The 3 Little Pigs<br>
			<input type="text" name="seed" oninput="validate(this);" placeholder="seed words">
			<input type="submit" id="submit" name="submit" disabled>
			</form>
			<h2 id="msg">Input can only contain letters or whitespaces</h2>
			<?php endif; ?>
			<?php
				if(isset($_POST['submit'])&& isset($_POST['story']))
				{
					$seeds = explode(" ",$_POST['seed']);
					//var_dump($seeds);
					$story=$_POST['story'];
					//var_dump($story);
					foreach($seeds as $seed)
					{
						for($i=0;$i<strlen($seed);$i++)
						{
							$space="";
							for($j=0;$j<$i; $j++)
							{
								$space.="_";
							}
							
							$query="SELECT * FROM $story WHERE words LIKE '".$space.$seed[$i]."%' ORDER BY RAND() LIMIT 1;";
							//echo $query;
							//echo "<br>";
							
							$results=mysqli_query($link,$query);
							while($row=mysqli_fetch_assoc($results))
							{
								$poem[]=$row['words'];
							}
						}
						$phrase="";
						foreach($poem as $p)
						{
							$phrase.=$p." ";
							$talk .=$p." ";
						}
						
						echo "<p>";
						echo $phrase;
						echo "</p>";
						
						$poem = array();
					}
					
				}
			?>
			
			<?php if(isset($_POST['submit'])):?>
			<h3>CLICK THIS BUTTON TO HEAR THE SPOOKY LADY READ YOUR POEM TO YOU (FROM BORROWED JS)</h3>
			<input onclick="responsiveVoice.speak('<?php echo $talk; ?>');" type="button" value="Play" />
			<?php endif;?>
			<!-- script from here: https://responsivevoice.org/text-to-speech-script-server/ -->
			<script src="https://code.responsivevoice.org/responsivevoice.js"></script>
			<script src="js/myscript.js"></script>
			</div>
		</body>
	</html>