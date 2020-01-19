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






		$fn = "http://www.textfiles.com/stories/13chil.txt";
	
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
		
		$insert = "INSERT INTO sly_fox VALUES ";
		
		echo $insert;
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
	
?>
