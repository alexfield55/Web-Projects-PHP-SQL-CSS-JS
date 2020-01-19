var userName = prompt("Enter your name");
var birthYear = prompt("What year were you born?");
var birthMonth = prompt("what month were you born?");
var age;
var ageRespone;
var birthStone;
var birthSeason;

age = 2019-birthYear;

if(age<50)
{
	ageRespone="You're still young!";
}
else
	ageRespone="Dang! You're old!";

birthMonth=birthMonth.toLowerCase();

switch(birthMonth)
{
	case "january":
		birthStone="Garnet";
		birthSeason="Winter";
		break;
	case "february":
		birthStone="Amethyst";
		birthSeason="Winter";
		break;
	case "march":
		birthStone="Bloodstone";
		birthSeason="Spring";
		break;
	case "april":
		birthStone="Diamond";
		birthSeason="Spring";
		break;
	case "may":
		birthStone="Emerald";
		birthSeason="Spring";
		break;
	case "june":
		birthStone="Pearl";
		birthSeason="Summer";
		break;
	case "july":
		birthStone="Ruby";
		birthSeason="Summer";
		break;
	case "august":
		birthStone="Sardonyx";
		birthSeason="Summer";
		break;
	case "september":
		birthStone="Sapphire";
		birthSeason="Fall";
		break;
	case "october":
		birthStone="Opal";
		birthSeason="Fall";
		break;
	case "november":
		birthStone="Topaz";
		birthSeason="Fall";
		break;
	case "december":
		birthStone="Torquise";
		birthSeason="Winter";
		break;
	default:
		birthStone="Month not recognized";
		birthSeason="Month not recognized";
		break;
}




alert("Happy Birthday " + userName + " " + ageRespone + " your birth stone is " + birthStone + " and you were born in " + birthSeason);



