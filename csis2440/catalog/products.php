<?php
	session_start();
	include("includes/db.php");
	$id="";
	
	if(isset($_GET['id']))
		$id=$_GET['id'];
	if(!isset($_POST['add-to-cart']) && !isset($_GET['id']))
		header('location: catalog.php');
	
	$price="";
	$name="";
	
	
?>
<!DOCTYPE html>
	<html>
		<head>
			<title>Description Page</title>
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
				
				
				echo "<div class='userform'>";
				echo "<h1>Item Description</h1>";
				if(!isset($_POST['add-to-cart']))
				{
					$query="SELECT * FROM product WHERE id = $id;";
					$results=mysqli_query($link,$query);
					
					$tO="<table><tr><th>Image</th><th>Name</th><th>Price</th><th>Description</th><tr>";
					$tC="</table>";
					$tG="";
				
					while($row = mysqli_fetch_assoc($results))
					{
						$tG.= "<tr>";
						$tG.= "<td><img width=200px src='".$row['image']."'></td>";
						$tG.= "<td>".$row['name']."</td>";
						$tG.= "<td>$".$row['price']."</td>";
						$tG.= "<td>".$row['description']."</td>";
						$tG.= "</tr>";
						
						$price = $row['price'];
						$name = $row['name'];
					}
					
					echo $tO.$tG.$tC;
					
					if(isset($_SESSION['user']))
					{
						
						echo "<form action='products.php' method='post'>";
						echo "<input type=hidden name='id' value=$id>";
						echo "<input type=hidden name='price' value=$price>";
						echo "<input type=hidden name='name' value=$name>";
						echo "<input type=text  id='prod' name='qty' oninput='validateQty(this);'>";
						echo "<input id='add-to-cart' disabled=true name='add-to-cart' type='submit' value='Add to Cart'>";
						echo "</form>";
						echo "<p id='qtyInput'>Choose How Many You Want!</p>";
					}
					else
					{
						echo "<p>Please Login to Order!</p>";
						echo "<form action='index.php' method='post'>";
						echo "<input type=submit value='Log In'>";
						echo "</form>";
					}
	
				
				}
				if(isset($_POST['add-to-cart']))
				{
					if(!isset($_SESSION['prod-name']))
					{
						$_SESSION['prod-id']= array();
						$_SESSION['prod-qty']= array();
						$_SESSION['prod-name']= array();
						$_SESSION['prod-price']= array();
						
					}
		
					if(!(array_search($_POST['name'],$_SESSION['prod-name'])===false))
					{
						$key=array_search($_POST['name'],$_SESSION['prod-name']);
						$_SESSION['prod-qty'][$key]+=$_POST['qty'];
					}
					else
					{
						array_push($_SESSION['prod-id'],$_POST['id']);
						array_push($_SESSION['prod-name'],$_POST['name']);
						array_push($_SESSION['prod-qty'],$_POST['qty']);
						array_push($_SESSION['prod-price'],$_POST['price']);
					}
				
					echo "<p>".$_POST['qty']." ".$_POST['name']."(s) added to cart!</p>";
					
				}
				echo "</div>";
				echo "</div>";
			?>			
			<script src="js/myscript.js"></script>
		</body>
	</html>