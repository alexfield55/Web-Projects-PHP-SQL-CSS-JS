<?php	

	
	function displayDefaultCheckbox($defaultValue)
	{
		global $link;
		$sql = "SELECT * FROM PALINDROME;";
		$results = mysqli_query($link, $sql);
		$ret='';
		$ret.='<input type="checkbox" name="default" ';
		if($defaultValue) $ret.='checked ';
		if(!mysqli_num_rows($results)) $ret.='disabled ';
		$ret.='>';
		return $ret;
	}
	
	
	function createDisplay($searchWord,$palCount,$default,$ec)
	{
			global $link;
			
		 //turn into display pals form
			if(isset($_POST['default']) && $_POST['default']=="on")
				$default = true;
			else	
				$default = false;
	
	
		if(empty($_POST['pals']) && !$default)
		{
			echo '<div class="form">';
			echo '<p>Enter Your Words</p>';
			echo '<form action="" method="post">';
			echo 	'<input type="hidden" name="searchWord" value= "'.$searchWord.'">';
			echo 	'<input type="hidden" name="palCount" value= "'.$palCount.'">';
					for($i=0; $i<$palCount; $i++)
						{
			echo 		 "<input name='pals[]'>";
						}
				
			echo 	'<input type="reset">';
			echo 	'<input type="submit">';
			echo '</form>';
			echo '</div>';
		}
		else
		{
			
			if($default)
			{
				$sql = "SELECT * FROM PALINDROME;";
				$results = mysqli_query($link, $sql);
				
				while($records = mysqli_fetch_array($results, MYSQLI_ASSOC))
				{
					$pali[] = $records['phrase'];	
				}
			}
			else
			{
				$pali = $_POST['pals'];
				
				
			}
			display($pali,$searchWord);
			
		}
	}
	
	function errorCheck() //error checks on palindrome page
	{
		$searchCounter = 0;
		$searchWord ="";
		$palCount = 0;
		$defaultValue = "";
		$ec=0;
		
		if(!empty($_POST['searchWord']))$searchWord = $_POST['searchWord'];
		else $ec+=1;
		
		if(!empty($_POST['default']))$defaultValue = $_POST['default'];
		else if(!empty($_POST['palCount']))$palCount = $_POST['palCount'];
		else $ec+=2;
		
		if($ec)
		{	
			header('location: index.php?w='.$searchWord.'&p='.$palCount.'&ec='.$ec.'&dv='.$defaultValue);
		}
		
		return array($searchWord,$palCount,$defaultValue,$ec);
	}
			
				
	function createVariables() //returns errors from palindrome page to index
	{
		if(isset($_GET['w']))
		{
			$wValue=$_GET['w'];
		}
		else
		{
			$wValue="";
		}
		
		if(isset($_GET['p']))
		{
			$pValue=$_GET['p'];
		}
		else
		{
			$pValue=0;
		}
		
		if(isset($_GET['dv']))
		{
			$defaultValue = $_GET['dv'];
		}
		else 
			$defaultValue = 0;
		
		if(isset($_GET['ec']))
		{
			$errorCodeVal = $_GET['ec'];
		}
		else $errorCodeVal=0;
		
		return array($wValue,$pValue,$defaultValue,$errorCodeVal);
	}
	
	
	function buildSelect($pValue, $allowedPals)
	{
		
		$ret ="";
		$ret .= '<select name="palCount">';
		$ret .='<option ';
		if(!$pValue) 
			$ret .= 'selected';
		$ret .= ' disabled>How May Palindromes?</option>';
		for($i=1; $i<=$allowedPals; $i++)
		{
			$ret .= '<option ';
			
			$ret.= ($i == $pValue ? 'selected' : '');
			
			$ret .=' value="'. $i .'">'.$i.' Palindrome'.($i>1?"s":"").'</option>';
		}			
		$ret .= '</select>';
		
		return $ret;
	}
	
	function errorMsg($errorCodeVal)
	{
		$ret = '';
		switch($errorCodeVal)
			{
				case 1: $ret= "<p class='warning'>Please Choose a Search Word</p>"; break;
				case 2: $ret= "<p class='warning'>Please Choose a Number of Palindromes</p>"; break;
				case 3: $ret= "<p class='warning'>Please Choose a Search Word and a Palindrome</p>"; break;
			}
		return $ret;
	}
	
	function display($p,$w)
	{
		global $searchCounter;
		global $link;
		
		echo "<div class='wrapper'>";
			for($i=0; $i<sizeof($p);$i++)
			{
				echo "<div class='facts'>";
					echo "<h1>Facts about \"$p[$i]\"</h1>";	
					echo "<ul>";
						echo "<li>Its word count is: " . str_word_count($p[$i]) ."</li>";
						echo "<li>Its length is: " .strlen($p[$i]). "</li>";
						echo "<li>Its palindrome statues is: " . (isPalindrome($p[$i])? "<span class='good'>true</span>" : "<span class='bad'>false</span>")."</li>";
					echo "</ul>";
				echo "</div>";
				
				if(strpos(cleanWord($p[$i]),cleanWord($w))> -1) $searchCounter++;
				
				if(isPalindrome($p[$i]))
				{
					$safeToInsert=true;
					$query = "SELECT * FROM PALINDROME;";
					$results = mysqli_query($link,$query) or die("Can't Connect". mysqli_connect_error());
					
					while($rows = mysqli_fetch_array($results, MYSQLI_ASSOC))
					{
						if(cleanWord($p[$i])==cleanWord($rows['phrase']))
						{
							$safeToInsert=false;
							$sql="UPDATE PALINDROME SET COUNTER = ".(++$rows['counter'])." WHERE ID = ".$rows['id'].";";
							break;
						}
					}
					if($safeToInsert)
					{
						$sql="INSERT INTO PALINDROME(phrase, counter) VALUES ('".$p[$i]."',1);";
					}
					mysqli_query($link, $sql);
				
				}
				
				
			}
		echo "</div>";
		echo "<h2>The # of phrases containing \"".ucfirst($w)."\": $searchCounter</h2>";
	}
	
	function cleanWord($p) //replace with regex
		{
			return strtolower(preg_replace("/(\w*)(\W*)/","$1",$p));
		}

	function isPalindrome($p)
		{
			$p = cleanWord($p);
			$temp = strrev($p);
			if($p==$temp) return true;
			else return false;
		}
?>