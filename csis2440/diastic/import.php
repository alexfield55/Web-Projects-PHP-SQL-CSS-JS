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

	if(isset($_POST['fileName']))
	{
		$fn=$_POST['fileName'];
		
		$tn=$_POST['tableName'];
		
		$query = "CREATE TABLE $tn (words char(20));";
		
		mysqli_query($link,$query);
	
		//$fn = 'http://textfiles.com/stories/13chil.txt'; //store filepath as varialbe

		$fs = fopen($fn, 'r'); //use opening function param filepath and r means read
		
		//$fileText = fread($fs, filesize($fn)); //store text from file using stream and size of file

		//var_dump(filesize($fs));

		$storyWords = fread($fs, 10000); //figure out file size from website?

		$storyWords = strtolower(preg_replace("/(\w*\b)(\W*\d*)/","$1 ",$storyWords));


		$words = explode(' ', $storyWords); //intilize and assign array by delimiter and file text
		
		for($i=(sizeof($words)-1); $i>0; $i--)
		{
			if(strlen($words[$i])<4)
				array_splice($words,$i,1);
		}
		
		$words = array_unique($words, SORT_STRING);
		
		$insert = "INSERT INTO $tn VALUES ";
		
		echo "table name";
		echo "<br>";
		var_dump($tn);
		var_dump($words);
		
		foreach($words as $word)
		{
			$insert.= "('".$word."'),";
		}
		
		$insert = substr($insert,0,-1);
		$insert .= ";";
		
		//var_dump($insert);
		
		mysqli_query($link,$insert);
		
		//if(isset($_POST['submit']))
			//foreach($words as $w)
				//echo $w . "<br>";

		/* looping a file by checking for end of file and some delimiter in loop
		while(!feof($fs))
		{
			echo '<p>'.fgets($fs).'</p>';
		}
		*/

		fclose($fs); // close file stream
	}
?>
<!DOCTYPE html>
	<html lang="en">
		<head><title>Text to DB</title><head>
		<body>			
			<h1>Turn a .txt file into a database of words</h1>
			<p>This is a plain tool to turn a .txt file into a database of words. This is probably way too much access to my database but it will create a table of your choosing. I didn't have time to have the index page dynamically generate radio buttons based on available tables in the db but that could be a feature, or a manually entered table name on that page. Anyways this totally works. I'll just have it echo everything as proof of concept.
			<form method="post" action="">
				<input type="text" name="fileName" placeholder="filepath goes here">
				<input type="text" name="tableName" placeholder="Table name goes here">
				<input type="submit" name="submit">
			</form>
		</body>
	</html>
	