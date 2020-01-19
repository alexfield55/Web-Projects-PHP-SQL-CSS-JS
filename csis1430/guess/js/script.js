var rand = Math.floor(Math.random()*100);
var numGuesses=0;

function resetGame()
{
	rand = Math.floor(Math.random()*100);
	numGuesses=0;
	document.getElementById("play").className = "show";
	document.getElementById("reset").className = "hide";
	document.getElementById("game-image").src="img/lets-play.jpg";
	document.getElementById("game-message").innerText="Let's Play a Game";
	document.getElementById("numGuess").innerText=numGuesses;
	document.getElementById("user-guess").select();
}

function playGame()
{
	var userGuess = document.getElementById("user-guess").value;
	
	if(userGuess==rand && numGuesses==1)
	{
		changeDispay("first");
	}
	else if(userGuess>rand)
	{
		changeDispay("high");
	}
	else if(userGuess<rand)
	{
		changeDispay("low");
	}
	else if(userGuess==rand)
	{
		changeDispay("win");
	}
	else
		changeDispay("error");
	
	numGuesses++;
	document.getElementById("numGuess").innerText=numGuesses;
	document.getElementById("user-guess").select();
}

function changeDispay(status)
{
	if(status=="first")
	{
		document.getElementById("game-message").innerText="First Try";
		document.getElementById("game-image").src = "img/first.jpg";
		document.getElementById("play").className = "hide";
		document.getElementById("reset").className = "show";
	}
	else if(status=="high")
	{
		document.getElementById("game-message").innerText="Too High!";
		document.getElementById("game-image").src = "img/too-high.jpg";
	}
	else if(status=="low")
	{
		document.getElementById("game-message").innerText="Too Low!";
		document.getElementById("game-image").src = "img/too-low.jpg";
	}
	else if(status=="win")
	{
		document.getElementById("game-message").innerText="Winner!";
		document.getElementById("game-image").src = "img/winner.jpg";	
		document.getElementById("play").className = "hide";
		document.getElementById("reset").className = "show";
	}
	else if(status=="error")
	{
		document.getElementById("game-message").innerText="Error!";
		document.getElementById("game-image").src = "img/error.jpg";
	}
}




