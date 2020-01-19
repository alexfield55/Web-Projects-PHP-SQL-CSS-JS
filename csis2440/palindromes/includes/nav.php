<?php

		$url = substr($_SERVER['PHP_SELF'],22);
		$fileNames = scandir('.');
		$urlArray[] = "index.php";
		
		for($i = 0; $i <sizeof($fileNames); $i++)
		{
			if(substr($fileNames[$i],-4) == '.php' && $fileNames[$i] != 'index.php')
			$urlArray[]=$fileNames[$i];
		}
		
		echo '<nav><ul>';
		
			for($i=0;$i<sizeof($urlArray);$i++)
			{
				if($url == 'palindromes.php' || ($url != 'palindromes.php' && $urlArray[$i] != 'palindromes.php'))
				{
					echo '<li';
					if($url==$urlArray[$i])
						echo ' class="active">';
					else
						echo '>';
					echo '<a href="'; //add active and change index to home
					echo $urlArray[$i];
					echo '">';
					if(substr($urlArray[$i],0,-4)=="index")
						echo "Home";
					else
						echo ucfirst(substr($urlArray[$i],0,-4));
					echo '</a></li>';
				}
			}
			
		echo '</ul></nav>';	
		
		
?>