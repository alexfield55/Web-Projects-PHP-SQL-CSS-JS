<?php	

	$url = substr($_SERVER['PHP_SELF'],25,-4);
	$title = array("index"=>"Music Home", "music"=>"Favorite Albums", "musicians"=>"Favorite Musicians", "products"=>"Products");
	echo '<head>
		<title>'.$title[$url].'</title>
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Creepster" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Metal%20Mania" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Nosifer" rel="stylesheet">
		<script src="js/myscript.js"></script>
	</head>';
	
?>