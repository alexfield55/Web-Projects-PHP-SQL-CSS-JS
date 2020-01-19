
window.addEventListener('mousedown',displayStuff);
window.addEventListener('keydown', showPic);


let table= document.getElementById("display");
//let open = "<table><tr><th>name</th><th>vocalist</th></tr>";
//let guts ="";
//let close ="</table>";
let counter = 0;
//someDiv.innerHTML=open;
//allows different data types in object array




let bands1=[
//you can define an object inside an array
	{
		name: "Slayer",
		vocal: "Tom Araya",
		guitar: "Jeff Hanneman",
		drums: "Dave Lombardo",
		bass: "Kerry King"
	}
];


//defining single object JSON
let band =
{
	name: "Slayer",
	vocal: "Tom Araya",
	guitar: "Jeff Hanneman",
	drums: "Dave Lombardo",
	bass: "Kerry King"
};

//object function
function Band(n,v,g,d,b)
{
	this.name = n;
	this.vocal = v;
	this.guitar = g;
	this.drum = d;
	this.bass= b;
	
	this.play=function() {console.log("Playing");}
}

//using object function
let band1 = new Band("Slayer","Tom Araya","Jeff Hanneman","Dave Lombardo","Kerry Kings");

//class structure
class DMBand
{
	constructor (n,v,g,d,b)
	{
		this.name = n;
		this.vocal = v;
		this.guitar = g;
		this.drum = d;
		this.bass= b;
	}
	
}



/*

for(el of bands)
{
	guts += "<tr><td>"+el.name+"</td><td>"+el.vocal+"</td></tr>";
}
someDiv.innerHTML=open+guts+close;
*/

let bands =
[
	new Band("Slayer","Tom Araya","Jeff Hanneman","Dave Lombardo","Kerry Kings"),
	new DMBand("slayer2","Tom Araya","Jeff Hanneman","Dave Lombardo","Kerry Kings"),
	new DMBand("Slayer3","Tom Araya","Jeff Hanneman","Dave Lombardo","Kerry Kings")
	
];


function displayStuff()
{
	if(counter<bands.length)
	{
		table.innerHTML += "<tr><td>"+bands[counter].name+"</td><td>"+bands[counter].vocal+"</td></tr>";
		counter++
	}

}

function picture(w,h)
{
	this.w =w;
	this.h=h;
	
	this.displayImage= function(e)
	{
		let string = "";
		
		switch(e)
		{
			case "1": string = "https://www.fillmurray.com/"; counter++; break;
			case "2": string = "https://lorempixel.com"; counter++; break;
			case "3": string = "https://picsum.photos"; counter++; break;
			
		}
		
		let imgTag = document.getElementById("images");
		
		imgTag.innerHTML += "<img src = " + string+this.w +"/"+this.h;+ ">";
	}
	
}

let images = [];

for(i=0;i<10;i++)
{
	let w = Math.floor(Math.random()*((400-200)+400));
	let h = Math.floor(Math.random()*((400-200)+400));
 
	images[i]= new picture(w,h);
}


function showPic(event)
{
	if(counter<images.length)
	{
		images[counter].displayImage(event.key);
	}
}







