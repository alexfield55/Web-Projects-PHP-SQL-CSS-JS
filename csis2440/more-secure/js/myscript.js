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

function playing()
{
	var backgroundSound = new sound("sounds/alarm.mp3");
	backgroundSound.play();
}

let pass="";
let vpass="";
let v = document.getElementById("v");
let sb = document.getElementById("submit");

function validate(input)
{
	let type;
	let id = input.attributes["id"].nodeValue;
	
	if(id=="vpass")
	{
		vpass=input.value;
		
	}
	if(id=="pass")
	{
		pass=input.value;
	}
	
	if(pass==vpass)
	{
		v.innerText="Passwords Match!";
		sb.disabled=false;
	
	}
	else 
	{
		v.innerText = "Passwords do not match!";
		sb.disabled=true;
	}
}
	