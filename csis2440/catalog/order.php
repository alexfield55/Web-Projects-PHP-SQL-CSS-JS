<?php
	session_start();
	include("includes/db.php");
	
	
	$first=	'';
	$last=	'';
	$add1=	'';
	$city=	'';
	$state=	'';
	$zip=	'';
	$phone=	'';
	$email=	'';
	
	if(isset($_POST['stored']))
	{
		if(isset($_SESSION['user']))
		{
			$query = "SELECT * FROM user WHERE username = '".$_SESSION['user']."';";
			$results = mysqli_query($link,$query);
			while($row = mysqli_fetch_assoc($results))
			{
				
				$first=	$row['first']; 						
				$last=	$row['last'];	
				$add1=	$row['address']; 		
				$city=	$row['city']; 	
				$state=	$row['st']; 
				$zip=	$row['zip']; 	
				$phone=	$row['phone']; 
				$email=	$row['email']; 
				
			}	
		}
	
	}
	
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
			<title>User Info Page</title>
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
				echo "<div class='login'>";
				
				if(isset($_POST['placed']))
					{
					if(isset($_POST['first']))  
						$first=$_POST['first']; 
					
					if(isset($_POST['last']))   
						$last=$_POST['last']; 
						
					if(isset($_POST['add1']))   
						$add1=$_POST['add1']; 
					
					if(isset($_POST['city'])) 	
						$city=$_POST['city']; 
					
					if(isset($_POST['state']))
						$state=$_POST['state']; 
					
					if(isset($_POST['zip'])) 	
						$zip=$_POST['zip']; 
					
					if(isset($_POST['phone']))	
						$phone=$_POST['phone']; 
					
					if(isset($_POST['email']))	
						$email=$_POST['email']; 
					
					echo "<div class='login'>";
					echo "<p>Thank you $first $last</p>";
					
					$total=0;
					
					for($i=0;$i<sizeof($_SESSION['prod-id']);$i++)
						{
							
							if($_SESSION['prod-qty'][$i]>0)
							{
								echo "<p>For your order of: ";
								echo $_SESSION['prod-qty'][$i];
								echo " ";
								echo $_SESSION['prod-name'][$i];
								echo "(s)";
								$total+= ($_SESSION['prod-qty'][$i]*$_SESSION['prod-price'][$i]);
								echo "</p>";
							}
						}
			
					echo "<p>For your order totaling $total</p>";
					echo "<p>Shipped to $add1, $city, $state $zip</p>";
					echo "<p>$email $phone</p>";
			
						unset($_SESSION['prod-id']);
						unset($_SESSION['prod-qty']);
						unset($_SESSION['prod-name']);	
						unset($_SESSION['prod-price']);
						
					echo "<img id='thatsall' alt='thatsall' src='img/thatsall.png'>";
					echo "</div>";
				}
			
				
				if(isset($_SESSION['user'])&&!isset($_POST['placed'])&&$qtyCheck>0)
				{
					
					echo "<h1>Your Order Information</h1>";
					
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
								$tG.= "<td>".$_SESSION['prod-price'][$i]."</td>";
								$tG.= "<td>".$_SESSION['prod-qty'][$i]."</td>";
								$tG.= "<td>".$_SESSION['prod-price'][$i]*$_SESSION['prod-qty'][$i]."</td>";
								$tG.= "</tr>";
								$total+= ($_SESSION['prod-qty'][$i]*$_SESSION['prod-price'][$i]);
							}
						}
						
						$tG.="<tr><td>Total</td><td></td><td></td><td>$$total</td></tr>";
						echo $tO.$tG.$tC;
					
						echo "<table class='userinfo'>";
					echo '<form method="post" action="order.php">';
					echo '
							<div>
							<tr>
							<td>First Name</td>
							<td><input id="first" name="first" type="text" value='.$first.'></td>
							<tr>
							</div>
							
							<div>
							<tr>
							<td><label for="last">Last Name</label></td>
							<td><input id="last" name="last" type="text" value='.$last.'></td>
							<tr>
							</div>
							
							<div>
							<tr>
							<td><label for="add1">Address</label></td>
							<td><input id="add1" name="add1" type="text" value='.$add1.'></td>
							</tr>
							</div>
				
							<div>
							<tr>
							<td><label for="city">City</label></td>
							<td><input id="city" name="city" type="text" value='.$city.'></td>
							</tr>
							</div>
							
							<div>
							<tr>
							<td><label>State</label></td>
							<td>
							<select class="state"   name="state">
								<option value="'.$state.'" selected disabled>'.$state.'</option>
								<option value="AL">Alabama</option>
								<option value="AK">Alaska</option>
								<option value="AZ">Arizona</option>
								<option value="AR">Arkansas</option>
								<option value="CA">California</option>
								<option value="CO">Colorado</option>
								<option value="CT">Connecticut</option>
								<option value="DE">Delaware</option>
								<option value="DC">District of Columbia</option>
								<option value="FL">Florida</option>
								<option value="GA">Georgia</option>
								<option value="HI">Hawaii</option>
								<option value="ID">Idaho</option>
								<option value="IL">Illinois</option>
								<option value="IN">Indiana</option>
								<option value="IA">Iowa</option>
								<option value="KS">Kansas</option>
								<option value="KY">Kentucky</option>
								<option value="LA">Louisiana</option>
								<option value="ME">Maine</option>
								<option value="MD">Maryland</option>
								<option value="MA">Massachusetts</option>
								<option value="MI">Michigan</option>
								<option value="MN">Minnesota</option>
								<option value="MS">Mississippi</option>
								<option value="MO">Missouri</option>
								<option value="MT">Montana</option>
								<option value="NE">Nebraska</option>
								<option value="NV">Nevada</option>
								<option value="NH">New Hampshire</option>
								<option value="NJ">New Jersey</option>
								<option value="NM">New Mexico</option>
								<option value="NY">New York</option>
								<option value="NC">North Carolina</option>
								<option value="ND">North Dakota</option>
								<option value="OH">Ohio</option>
								<option value="OK">Oklahoma</option>
								<option value="OR">Oregon</option>
								<option value="PA">Pennsylvania</option>
								<option value="RI">Rhode Island</option>
								<option value="SC">South Carolina</option>
								<option value="SD">South Dakota</option>
								<option value="TN">Tennessee</option>
								<option value="TX">Texas</option>
								<option value="UT">Utah</option>
								<option value="VT">Vermont</option>
								<option value="VA">Virginia</option>
								<option value="WA">Washington</option>
								<option value="WV">West Virginia</option>
								<option value="WI">Wisconsin</option>
								<option value="WY">Wyoming</option>
							</select>
							</td>
							</tr>
							</div>
							
							<div>
							<tr>
							<td><label for="zip">Zip Code</label></td>
							<td><input id="zip" name="zip" type="text" value='.$zip.'></td>
							</tr>
							</div>
							
							<div>
							<tr>
							<td><label for="phone">Phone Number</label></td>
							<td><input id="phone" oninput="validatePE(this);" name="phone" type="text" value='.$phone.'></td>
							</tr>
							</div>
							
							<div>
							<tr>
							<td><label for="email">Email</label></td>
							<td><input id="email" name="email" oninput="validatePE(this);" type="text" value='.$email.' ></td>
							</tr>
							</div>
						
							';
						echo '<div><tr>';
							
						echo '<td><input type="submit" name="stored" value="Use Stored Account Info?"></td>';
						echo '<td><input id="updatebutton" name="placed" type ="submit" value="Place Order"></td></tr></div>';
						
						echo '</tr>';
				
						echo '</form>';
				
						echo "</table>";
						
						echo "<p id='p'>Please Enter Phone Format xxx-xxx-xxxx</p>";
						echo "<p id='e'>Please Enter Email Format yourname@youremail.com<p>";
				}
				else if (!isset($_SESSION['user']))
					echo "<h1>Please Login to Place Order!</h1>";
				else if($qtyCheck==0)
					echo "<h1>Your cart is empty!</h1>";
				
			
				
				echo "</div>";
				echo "</div>";
			?>
			<script src="js/myscript.js"></script>
		</body>
	</html>