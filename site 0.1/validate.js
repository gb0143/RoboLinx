function validForm(){
	var FormGood = true;
	if(!validName()){
		FormGood = false;
	}
	if(!validEmail()){
		FormGood = false;
	}
	return FormGood;
}


//This function validates the email
function validEmail()
{
var x=document.forms["loginForm"]["email"].value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
	document.getElementById('badEmail').style.display = "";
	document.getElementById("email").style.backgroundColor = "#CC3300";
	document.getElementById("email").style.color = "black";
	return false;
  }
  document.getElementById('badEmail').style.display = "none";
  document.getElementById("email").style.backgroundColor = "";
  document.getElementById("email").style.color = "black";
  return true;
}

//This function validates the name
function validName()
{
var x=document.forms["loginForm"]["fname"].value;
	if(x == null || x == ""){
		document.getElementById('badName').style.display = "";
		document.getElementById("fname").style.backgroundColor = "#CC3300";
		document.getElementById("fname").style.color = "black";
		return false;
	}
  document.getElementById('badName').style.display = "none";
  document.getElementById("fname").style.backgroundColor = "";
  document.getElementById("fname").style.color = "black";
  return true;
}