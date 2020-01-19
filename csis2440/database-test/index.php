<h1>Database Test</h1>
<?php
	//define constants
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
		define("USER", "id10790851_pali");
		define("PASS", "666999");
		define("DATABASE", "id10790851_palindromes");	
	}
	
	//connect to db
	$link = mysqli_connect(HOST, USER, PASS, DATABASE);
	//write db query
	$query = "select * from PALINDROME";
	
	//run query
	$results = mysqli_query($link,$query) or die("Can't Connect". mysqli_connect_error());
	
	//loop return
	while($rows = mysqli_fetch_array($results, MYSQLI_ASSOC))
	{
		echo $rows['phrase'].'<br>';
	}
	
	mysqli_close($link);

?>