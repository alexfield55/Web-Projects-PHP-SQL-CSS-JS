var count = 1;

function quotes()
{
	if(count>4) count=1;
	if(count==1)document.getElementById("quotes").innerText="The secret of creativity is knowing how to hide your sources. -ALBERT EINSTEIN";
	if(count==2)document.getElementById("quotes").innerText="Two things are infinite: the universe and human stupidity; and I'm not sure about the universe. -ALBERT EINSTEIN";
	if(count==3)document.getElementById("quotes").innerText="I can resist everything except temptation. -OSCAR WILDE";
	if(count==4)document.getElementById("quotes").innerText="Get your facts first, then you can distort them as you please. -MARK TWAIN";
	count++;
	
}

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
	var backgroundSound = new sound("sound/rain.mp3");
	backgroundSound.play();
}
