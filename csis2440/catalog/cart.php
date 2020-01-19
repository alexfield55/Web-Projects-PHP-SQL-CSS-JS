<?php
	session_start();
	include("includes/db.php");
	
	$qtyCheck=0;
	
	if(isset($_SESSION['user'])&&isset($_SESSION['prod-qty']))
	{
		for($i=0;$i<sizeof($_SESSION['prod-qty']);$i++)
		{
			if(isset($_POST['qty'.$i]))
			{
				$_SESSION['prod-qty'][$i]=$_POST['qty'.$i];
				$qtyCheck+=$_POST['qty'.$i];
			}
			else
				$qtyCheck+=$_SESSION['prod-qty'][$i];
		}
	}
?>
<!DOCTYPE html>
	<html>
		<head>
			<title>Cart Page</title>
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
			
				if(!isset($_SESSION['user']))
					
				{
					echo "<h1>Please Login to View You Cart!</h1>";
				}
				else if(isset($_SESSION['user'])&&$qtyCheck>0)
				{
					echo "<div class='cart'>";
				
						echo "<form action='cart.php' method='post'>";
						$tO="<table><tr><th>Name</th><th>Price</th><th>Qty</th><th>Total</th><tr>";
						$tC="</table>";
						$tG="";
						$total=0;
			
						for($i=0;$i<sizeof($_SESSION['prod-id']);$i++)
						{
							
							if($_SESSION['prod-qty'][$i]>0)
							{
								$tG.= "<tr>";
								$tG.= "<td>".$_SESSION['prod-name'][$i]."</td>";
								$tG.= "<td>$".$_SESSION['prod-price'][$i]."</td>";
								$tG.= "<td><input id='cart' oninput='validateQty(this);' name='qty$i' type='text' value='";
							
								$tG.=$_SESSION['prod-qty'][$i]; //add live js check for qty input
								$tG.="'></td>";
								$tG.= "<td>$".$_SESSION['prod-price'][$i]*$_SESSION['prod-qty'][$i]."</td>";
								$tG.= "</tr>";
								
								$total+= ($_SESSION['prod-qty'][$i]*$_SESSION['prod-price'][$i]);
							}
						}
						$tG.="<tr><td></td><td></td><td>Total</td><td>$$total</td></tr>";
						
						
						$tG.="<tr><td></td><td></td><td><input id='add-to-cart' type='submit' value='Update Cart'></td>";
						$tG.="<td><input id='proceed' type='submit' formaction='order.php' value='Proceed to Checkout'></td></tr>";
					
						$tG.= "<tr><td colspan='4'><p id='qtyInput'>Choose to Update your Cart!</p></td></tr>";
						echo $tO.$tG.$tC;	
						echo "</form>";
					
					echo "</div>";
				}
				else //check cookie or session
					echo "<h1>Your cart is empty!</h1>";
	
				
				echo "</div>";
			?>
			<script src="js/myscript.js"></script>
		</body>
	</html>