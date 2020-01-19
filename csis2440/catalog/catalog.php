<?php
	session_start();
	include("includes/db.php");
	$loggedIn=false;
	
	if(isset($_SESSION['loggedIn']))
		$loggedIn=true;
	
?>
<!DOCTYPE html>
	<html lang="en">
		<head>
			<title>Catalog Page</title>
			<link href="css/style.css" rel="stylesheet" type="text/css">
			<meta charset="UTF-8"/>
		</head>
		<body>
			<?php
			echo "<div class='navbar'>";
			include("includes/nav.php");
			include("includes/logbox.php");
			echo "</div>";
			echo "<div class='mainwrap'>";
			echo "<h1>Product Catalog</h1>";
				$tO="<table><tr><th>Image</th><th>Name</th><th>Price</th><th>Link to Product</th></tr>";
				$tC="</table>";
				$tG="";
				
				$query="SELECT * FROM product";
				$results=mysqli_query($link,$query);
				
				while($row = mysqli_fetch_assoc($results))
				{
					$tG.= "<tr>";
					$tG.= "<td><img alt='".$row['name']."' width='200' src='".$row['image']."'></td>";
					$tG.= "<td>".$row['name']."</td>";
					$tG.= "<td>$".$row['price']."</td>";
					$tG.= "<td><a href='products.php?id=".$row['id']."'>View Description</a></td>";
					$tG.= "</tr>";
				}
				echo $tO.$tG.$tC;
			echo "</div>";
			?>
		</body>
	</html>