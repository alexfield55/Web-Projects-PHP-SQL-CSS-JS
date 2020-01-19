let v = document.getElementById("msg");
let sb = document.getElementById("submit");

function validate(input)
{
	let regex = /^[A-Za-z ]+$/;
	let myString = input.value;
	
	if(myString.match(regex))
	{
		v.innerText="Good Input";
		sb.disabled=false;
	
	}
	else 
	{
		v.innerText = "input contains something other than letters or whitespaces";
		sb.disabled=true;
	}
}
	