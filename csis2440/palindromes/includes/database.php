<?php
if($_SERVER['HTTP_HOST'] == "localhost")
	{
		define("HOST", "localhost");
		define("USER", "root");
		define("PASS", "1550");
		define("DATABASE", "palindromes");
	}
	else
	{
		define("HOST", "localhost");
		define("USER", "alexfiel_alexfie");
		define("PASS", "DvCq-=wk7fb0");
		define("DATABASE", "alexfiel_PALINDROMES");	
	}
	
	$link = mysqli_connect(HOST, USER, PASS, DATABASE);

?>				