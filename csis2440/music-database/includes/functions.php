<?php

	function buildNav()
	{
		$url = substr($_SERVER['PHP_SELF'],25,-4);
		echo '<nav>
				<ul>
					<li'.($url=="index" ? " class=active ":""). '><a href="index.php">Home</a></li>
					<li'.($url=="music" ? " class=active ":""). '><a href="music.php">Albums</a></li>
					<li'.($url=="musicians" ? " class=active ":""). '><a href="musicians.php">Musicians</a></li>
					<li'.($url=="products" ? " class=active ":""). '><a href="products.php">Products</a></li>
				</ul>
			</nav>';	
	}

	function displayTable($data)
	{
			$url = substr($_SERVER['PHP_SELF'],25,-4);
			echo "<table>";
				if($url=="music") echo "<tr><th>Artist</th><th>Album</th></tr>";
				if($url=="musicians") echo "<tr><th>Artist</th><th>Why I Like Them</th></tr>";
				foreach ($data as $k => $v)
					echo "<tr><td>$k</td><td>$v</td></tr>";
			echo "</table>";
			
		
	}

	function createAlbumArray()
	{	
		$albums = array(
						"Slayer" => "South of Heaven",
						"Nile" => "At the Gates of Sethu", 
						"Sunn O)))" => "Monoliths and Dimensions", 
						"Primitive Man" => "Scorn", 
						"Dark Castle" => "Spirited Migration", 
						"Fallujah" => "Undying Light", 
						"Behemoth" => "I Loved You at your Darkest", 
						"Arkaik" => "Nemethia", 
						"Gatecreeper" => "Deserted", 
						"Cult of Luna" => "The Silent Man", 
					);	
		return $albums;
	}

	function createMusicPeopleArray()
	{
		$musicPeople = array(
							"Karl Sanders" => "Writes the best solos in metal",
							"Nader Sadek" => "Let me hang out at his house in Egypt", 
							"Jason Keyser" => "Most energetic frontman in metal", 
							"Dave Lombardo" => "Best thrash metal drummer out there", 
							"Ozzy Osbourne" => "The Original", 
						
						);
						
		return $musicPeople;
	}





?>