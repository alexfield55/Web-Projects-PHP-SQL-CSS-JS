let x = new XMLHttpRequest();
let i ="";

document.getElementById("bill-button").addEventListener('mousedown',getBill);

function getBill()
{
	if(x.status==200 && x.readyState ==4)
	{
		
		i=x.responseText;
		document.getElementById("bill-image").innerHTML = i;
		
	}
	x.open("GET", "bill.php", true);
	x.send();
}
