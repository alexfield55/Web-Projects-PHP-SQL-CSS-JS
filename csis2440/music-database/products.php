<?php 
	include('includes/functions.php');
	$ec=1;
	
	if(isset($_POST['artist'])) $artist=$_POST['artist']; 
	else {$artist=''; $ec++;}
	
	if(isset($_POST['color'])) $color=$_POST['color']; 
	else {$color=''; $ec++;}
	
	if(isset($_POST['size'])) $size=$_POST['size'];
	else {$size=''; $ec++;}
	
	if(isset($_POST['style'])) $style=$_POST['style']; 
	else {$style=''; $ec++;}
	
	if(isset($_POST['artist'])&& isset($_POST['color']) && isset($_POST['size']) && isset($_POST['style'])) $ec=0;
		
	if(isset($_POST['first'])) $first=$_POST['first']; else $first='';		
	if(isset($_POST['last'])) $last=$_POST['last']; else $last='';		
	if(isset($_POST['add1'])) $add1=$_POST['add1']; else $add1='';		
	if(isset($_POST['add2'])) $add2=$_POST['add2']; else $add2='';		
	if(isset($_POST['city'])) $city=$_POST['city']; else $city='';		
	if(isset($_POST['state'])) $state=$_POST['state']; else $state='';	
	if(isset($_POST['zip'])) $zip=$_POST['zip']; else $zip='';	
	if(isset($_POST['phone'])) $phone=$_POST['phone']; else $phone='';	
	if(isset($_POST['email'])) $email=$_POST['email']; else $email='';	

	
	$albums = createAlbumArray();
	$artists = array();
	foreach ($albums as $k => $v) array_push($artists, $k);
	$colors = array("black", "white", "red", "purple", "blue");
	$sizes = array("small", "medium", "large", "xl", "xxl");
	$styles = array("jersey", "t-shirt", "long sleeve", "hoodie", "tank top");

?>
<!DOCTYPE html>
	<html lang="en">
		<?php include('includes/head.php'); ?>
		<body onload="playing();">
			<?php buildNav();?>
			
			<h1>Products</h1>
			
			<?php 
				if($ec>0)
				{
					echo '<form method="post" action="products.php">';
					echo buildSelect($artists, $artist, "artist"); 
					echo buildSelect($colors, $color, "color");
					echo buildSelect($sizes, $size, "size");
					echo buildSelect($styles, $style, "style");
					displayForm();	
					echo '<br><div><input type ="reset">';
					echo '<input type ="submit"></div>';
					echo '</form>';
				}
				else
				{
					echo '<h1>Completed Order</h1>';
					echo '<p>'.$first.' '.$last.'</p>';
					echo '<p>'.$add1.' '.$add2.'</p>';
					echo '<p>'.$city.', '.$state.' '.$zip.'</p>';
					echo '<p>'.$email.'</p>';
					echo '<p>'.$phone.'</p>';
					echo '<p>Ordered: 1 '.$size.' '.$color.' '.$artist.' '.$style.'</p>';
					
				}
			?>
		</body>
	</html>
	
<?php	
	
	function buildSelect($array, $val, $name)
	{
		
		$ret ="";
		$ret .= '<select class="dropdown" name="'.$name.'" >';
		$ret .='<option ';
		if(!$val) 
			$ret .= 'selected';
		$ret .= ' disabled>What '.$name.'?</option>';
		foreach ($array as $k)
		{
			$ret .= '<option ';
			
			$ret.= ($k==$val? 'selected' : '');
			
			$ret .=' value="'. $k.'">'.$k.'</option>';
			
		}
		
		$ret .= '</select>';
		
		return $ret;
	}
	
	
	function displayForm()
	{
		
			echo '
			<div>
			<label for="first">First Name</label>
			<input id="first" name="first" type="text" placeholder="First Name">
			</div>
			
			<div>
			<label for="last">Last Name</label>
			<input id="last" name="last" type="text" placeholder="Last Name">
			</div>
			
			<div>
			<label for="add1">Address Line 1</label>
			<input required id="add1" name="add1" type="text" placeholder="Address Line 1">
			</div>
			
			<div>
			<label for="add2">Address Line 2</label> 
			<input id="add2" name="add2" type="text" placeholder="Address Line 2">
			</div>
			
			<div>
			<label for="city">City</label> 
			<input required id="city" name="city" type="text" placeholder="City">
			</div>
			
			<div>
			<label>State</label>
			 
			<select class="state" required name="state">
				<option value="" selected disabled>State</option>
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
			</div>
			
			<div>
			<label for="zip">Zip Code</label>
			<input required id="zip" name="zip" type="text" placeholder="Zip Code">
			</div>
			
			<div>
			<label for="phone">Phone Number</label>
			<input required id="phone" name="phone" type="text" placeholder="xxx-xxx-xxxx">
			</div>
			
			<div>
			<label for="email">Email</label>
			<input required id="email" name="email" type="text" placeholder="yourname@email.com">
			</div>
		
			';
		
		
		
		
	}
	
?>