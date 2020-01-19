
var lottoArray = [];

for (var i = 0; i<numPicks; i++)
{
	lottoArray[i]= Math.floor(Math.random()*100);
}

for (var i = 0; i<lottoArray.length; i++)
{
	if(i==0) pickList += lottoArray[i];
	else pickList += "-" + lottoArray[i];
}



function newNumbers()
{
	
	var numPicks = document.getElementById("numbers").value;
	
	var newList = ""
	
	for (var i = 0; i<numPicks; i++)
	{
		lottoArray[i]= Math.floor(Math.random()*100);
		if(i==0) newList += lottoArray[i];
		else newList += "-" + lottoArray[i];
	}
	
	document.getElementById("lotto").innerText = newList;
}
