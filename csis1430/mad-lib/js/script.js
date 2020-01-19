var noun1;
var noun2;
var verb1;
var verb2;
var adj1;
var adj2;
var msg;

alert("Welcome to the Mad-Lib game, I will ask you to enter some words!");
var noun1=prompt("Please enter a noun");
var noun2=prompt("Please enter a noun");
var verb1=prompt("Please enter a verb");
var verb2=prompt("Please enter a verb");
var adj1=prompt("Please enter an adjective");
var adj2=prompt("Please enter an adjective");

msg="Hello! I am a " + noun1 + " and I can " + verb1 + " quickly. My favorite sport is " + noun2 + " and I watch is one my " + adj1 + " television. I can " + verb2 + " television all day long. Its my favorite way to spend my " +adj2+ " day."


function produceMessage()
{
	return msg;
}