<?php

	if(isset($_GET['e']))
	{
		$email=$_GET['e'];
	}
	else
	{
		$email=null;
	}
	
	if(isset($_GET['p']))
	{
		$phone=$_GET['p'];
	}
	else
	{
		$phone=null;
	}
	
	if(isset($_GET['ec']))
	{
		$errorCodeVal = $_GET['ec'];
	}
	else $errorCodeVal=0;

?>

<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>Home Page for Validation</title>
			<link href="css/style.css" rel="stylesheet" type="text/css">
		</head>
		<body>	
			<div class="display">
				<h1>Home Page for Validation</h1>
				<form method="post" action="process.php">
					<input name ="email" type ="text" placeholder="email" <?php echo (isset($_GET['p'])==true) ? 'value="'.$email.'"' : "";?>>
					<input name ="phone" type ="text" placeholder = "(xxx)xxx-xxxx" <?php echo (isset($_GET['e'])==true) ? 'value="'.$phone.'"' : "";?>>
					<input type ="reset">
					<input type ="submit">
					<?php if($errorCodeVal) echo errorMsg($errorCodeVal); ?>
					<?php if($errorCodeVal) echo '<img class="errorImg" alt="error" src="'.errorImg($errorCodeVal).'">';?>
				</form>
			</div>
		</body>
	</html>
	
<?php

	function errorMsg($errorCodeVal)
	{
		$ret = '';
		switch($errorCodeVal)
			{
				case 1: $ret= "<p class='warning'>Please enter a valid email address ie: yourname@email.com</p>"; break;
				case 2: $ret= "<p class='warning'>Please enter a valid phone number ie: (xxx)xxx-xxxx</p>"; break;
				case 3: $ret= "<p class='warning'>Please enter both a valid email ie: yourname@email.com and phone number ie: (xxx)xxx-xxxx</p>"; break;
			}
		return $ret;
	}

	function errorImg($ec)
	{
		$ret="img/";
		$ret.=$ec;
		$ret.=".jpg";
		return $ret;
	}

?>