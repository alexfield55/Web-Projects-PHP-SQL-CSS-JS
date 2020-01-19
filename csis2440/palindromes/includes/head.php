<?php	

	$url = substr($_SERVER['PHP_SELF'],22,-4);
	if($url=="index") $title = "Palindrome App";
	else $title = ucfirst($url)." Page";
	echo '<head>
		<title>'.$title.'</title>
		<link href="css/style.css" rel="stylesheet" type="text/css">
	</head>';
?>