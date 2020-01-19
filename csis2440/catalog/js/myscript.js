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
let username ="";
let v = document.getElementById("v");
let w = document.getElementById("w");
let x = document.getElementById("x");
let sb = document.getElementById("submit");
let qty = document.getElementById("qtyInput");
let addToCart = document.getElementById("add-to-cart");
let proceed = document.getElementById("proceed");
let regTest = document.getElementById("regTest");
let userID = document.getElementById("user");
let emailIn = document.getElementById("email");
let phoneIn = document.getElementById("phone");
let e = document.getElementById("e");
let p = document.getElementById("p");
let update = document.getElementById("updatebutton");
let eCheck=false;
let pCheck=false;

function validatePE(input)
{
	let check=input.value;
	let id = input.attributes["id"].nodeValue;
	
	phonereg= new RegExp(/^(\()?\d{3}(\))?(-|\s)?\d{3}(-|\s)\d{4}$/);
	emailreg= new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
	
	if(id=="email") //add flags for button
	
	{
		if(emailreg.test(check))
		{
			e.innerText="Valid Email";
			eCheck=true;
			
		}
		else
			e.innerText="Invalid Email Format";
	}
	if(id=="phone")
	{
		if(phonereg.test(check))
		{
			p.innerText="Valid Phone";
			pCheck=true;
		}
		else
			p.innerText="Invalid Phone Format, must be xxx-xxx-xxxx";
	}
	if(pCheck&&eCheck)
		update.disabled=false;
	else
		update.disabled=true;
}

function validateQty(input)
{

	let qtyCheck=input.value;
	let id = input.attributes["id"].nodeValue;
	let reg = new RegExp(/^\d+$/);

	
	if(id=="prod")
	{
		if(qtyCheck<1 && reg.test(qtyCheck))
		{
			qty.innerText="Must be nonzero positive interger!";
			addToCart.disabled=true;
		}
		else if(!reg.test(qtyCheck))
		{
			qty.innerText="Must be nonzero positive interger!";
			addToCart.disabled=true;
		}
		else
		{
			qty.innerText="Click Add to Cart!";
			addToCart.disabled=false;
		}
	}
	if(id=="cart")
	{
		if(qtyCheck<-1 && reg.test(qtyCheck))
		{
			qty.innerText="Must be zero or a positive number!";
			addToCart.disabled=true;
			proceed.disabled=true;
		}
		else if(!reg.test(qtyCheck))
		{
			qty.innerText="Must be zero or a positive interger!";
			addToCart.disabled=true;
			proceed.disabled=true;
		}
		else if(reg.test(qtyCheck)&&qtyCheck==0)
		{
			qty.innerText="Click to Update Cart";
			addToCart.disabled=false;
			proceed.disabled=true;
		}
		else
		{
			qty.innerText="Click to Update Cart or Proceed to Checkout!";
			addToCart.disabled=false;
			proceed.disabled=false;
		}
	}
	
}

function validate(input)
{

	let id = input.attributes["id"].nodeValue;
	let reg1=/^(\S){8,}$/;
	let reg2=/^\S*\d+\S*$/;
	let reg3 = /^.{1,10}$/;
	let uCheck= false;
	let pCheck = false;
	let vCheck = false;

	
	if(id=="user")
	{
		username = input.value;
	}
	
	if(id=="vpass")
	{
		vpass=input.value;
		
	}
	if(id=="pass")
	{
		pass=input.value;
	}
	
	if(reg3.test(username))
	{
		x.innerText="Username is valid";
		uCheck=true;
	}
	else
	{
		x.innerText="Username must have 1-10 characters";
		uCheck=false;
	}
	
	if(!(pass.match(reg1)&&pass.match(reg2)))
	{
		w.innerText="password must contain number and be 8 characters long";
		pCheck=false;
	}
	
	if(!pass.match(reg1)&&pass.match(reg2))
	{
		w.innerText="password must be 8 characters long";
		pCheck=false;
	}
	
	if(pass.match(reg1)&&!pass.match(reg2))
	{
		w.innerText="password must contain 1 number";
		pCheck=false;
	}
	
	if(pass.match(reg1)&&pass.match(reg2))
	{
		w.innerText="Password accepted";
		pCheck=true;
	
	}
	if(pass.match(reg1)&&pass.match(reg2)&&pass==vpass&&username.match(reg3))
	{
		w.innerText="Password Accepted!";
		v.innerText="Passwords Match!";
		x.innerText="Username Valid!";
		sb.disabled=false;
	
	}
	else
	{
			sb.disabled=true;
	}
	
	if(pass==vpass)
	{
		v.innerText="Passwords Match!";
		pCheck=true;
	}
	else 
	{
		v.innerText = "Passwords do not match!";
		pCheck=false;;
	}
	
}
	