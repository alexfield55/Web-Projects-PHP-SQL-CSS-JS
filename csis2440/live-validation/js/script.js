var eflag = pflag = false;

function validate(input)
{
	let id = input.attributes["id"].nodeValue;
	let p = document.getElementById("p");
	let e = document.getElementById("e");
	let sb = document.getElementById("submit");
	
	if(id=="pin")
		p.innerText = isValid(input.value,0);
	else if(id=="ein")
		e.innerText = isValid(input.value,1);
	if(pflag && eflag)
		sb.disabled = false;
	else
		sb.disabled = true;
	
	
}

function isValid(str, type)
{
	//type = 0 is phone
	//type = 1 is email
	
	let reg =  /^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/;
	return reg.test(str);
	
	
	/*
	let reg, msg, ret;
	let p = document.getElementById("p");
	let e = document.getElementById("e");
	
	switch(type)
	{
		case 0: reg =  /^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/;
		
				msg = "phone";
				ret = reg.test(str);
				if(ret)
					{
						pflag = true; 
						p.className="valid";
					}
				else
					{
						pflag = false; 
						p.classname="invalid";
					}
				break;
		case 1: reg = "";//emails
		
				msg = "email";
				ret = reg.test(str);
				if(ret)
					{
						eflag = true;
						e.className="valid";
					}
				else
					{
						eflag = false; 
						e.classname="invalid";
					}
				break;
	}
	
	return msg + " is " + (ret) ? "valid" : "not valid";
*/
	
}