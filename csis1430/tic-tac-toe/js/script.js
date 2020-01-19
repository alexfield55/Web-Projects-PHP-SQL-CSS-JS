var markers = ["X","O"];
var turn = 0;
var playersArray=["Player 1", "Player 2"];
var totals = [0,0];
var winArray = [7,56,73,84,146,273,292,448];
var gameOver = false;
var winSound;
var tieSound;

function sound(src)
 {
  this.sound = document.createElement("audio");
  this.sound.src = src;
  this.sound.setAttribute("preload", "auto");
  this.sound.setAttribute("controls", "none");
  this.sound.style.display = "none";
  document.body.appendChild(this.sound);
  this.play = function(){
    this.sound.play();
  }
  this.stop = function(){
    this.sound.pause();
  }
}

function players()
{
	document.getElementById("whose-playing").innerText = document.getElementById("p1").value + " vs " + document.getElementById("p2").value;
	playersArray[0]=document.getElementById("p1").value;
	playersArray[1]=document.getElementById("p2").value;
}

function playGame(div, point)
{
	if(!gameOver)
	{
		div.innerText=markers[turn];
		totals[turn]+= point;
		
		if(isWin())
		{
			document.getElementById("whose-turn").innerText = playersArray[turn] + " Wins!";
			
			winSound = new sound("sounds/win.mp3");
			winSound.play();
		}
		else if(gameOver)
		{
			document.getElementById("whose-turn").innerText = "Game Over, Tied Game!";
		}
		else
		{

			if(turn)turn=0;
			else turn=1;
			div.attributes["0"].nodeValue=""; //strip onclick function
			document.getElementById("whose-turn").innerText = "It's " + playersArray[turn] + "'s turn";
		}
	}
}

function isWin()
{
	for(var i=0;i<winArray.length;i++)
	{
		if((totals[turn]&winArray[i])==winArray[i])
		{
			gameOver=true;
			return true;
		}
	}
	if((totals[0]+totals[1])==511)
	{
		gameOver = true;
		tieSound = new sound("sounds/sad.mp3");
		tieSound.play();
	}
	return false;
}

function playAgain()
{
	totals=[0,0];
	gameOver = false;
	var board = document.getElementById("board");
	var counter = 1;
	var innerDivs="";
	for(var i = 1; i<=3; i++)
	{
		innerDivs+='<div id="row-'+i+'">';
		for(var j=1; j<=3; j++)
		{
			innerDivs+='<div onclick="playGame(this,'+ counter + ');"></div>';
			counter *=2;
		}
		innerDivs+='</div>';		
	}
	board.innerHTML = innerDivs;
	
	
}