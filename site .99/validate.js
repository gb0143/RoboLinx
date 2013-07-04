/*********************Validate the Login form******************/
function validLForm(){
	var FormGood = true;
	if(!validName()){
		FormGood = false;
	}
	if(!validPass()){
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

//This function validates the submission form
function validateSubmit()
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
	if(x.length < 6){
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

//This function validates the password
function validPass()
{
var x=document.forms["loginForm"]["pass"].value;
	if(x.length < 6){
		document.getElementById('badPass').style.display = "";
		document.getElementById("pass").style.backgroundColor = "#CC3300";
		document.getElementById("pass").style.color = "black";
		return false;
	}
  document.getElementById('badPass').style.display = "none";
  document.getElementById("pass").style.backgroundColor = "";
  document.getElementById("pass").style.color = "black";
  return true;
}

/************** Validate the New User Form *************/
function validNForm(){
	var formGood = true;
	if(!validEMail()){
		formGood = false;
	}
	if(!validUName()){
		formGood = false;
	}
	if(!validPass1()){
		formGood = false;
	}
	if(!validPass2()){
		formGood = false;
	}
	return formGood;
}

function validateForm()
{
var x=document.forms["myForm"]["email"].value;
var atpos=x.indexOf("@");
var dotpos=x.lastIndexOf(".");
if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  {
  alert("Not a valid e-mail address");
  return false;
  }
}

function validEMail(){
	var x=document.forms["newUserForm"]["eMail"].value;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	if(atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length){
		document.getElementById('badEMail').style.display = "";
		document.getElementById("eMail").style.backgroundColor = "#CC3300";
		document.getElementById("eMail").style.color = "black";
		return false;
	}
	document.getElementById('badEMail').style.display = "none";
	document.getElementById("eMail").style.backgroundColor = "";
	document.getElementById("eMail").style.color = "black";
	return true;
}

function validUName(){
	var x=document.forms["newUserForm"]["uname"].value;
	if(x.length < 6){
		document.getElementById('badUserName').style.display = "";
		document.getElementById("uname").style.backgroundColor = "#CC3300";
		document.getElementById("uname").style.color = "black";
		return false;
	}
	document.getElementById('badUserName').style.display = "none";
 	document.getElementById("uname").style.backgroundColor = "";
  	document.getElementById("uname").style.color = "black";
	return true;
}

function validPass1(){
	var x=document.forms["newUserForm"]["pass1"].value;
	if(x.length < 6){
		document.getElementById('badPass1').style.display = "";
		document.getElementById("pass1").style.backgroundColor = "#CC3300";
		document.getElementById("pass1").style.color = "black";
		return false;
	}
	document.getElementById('badPass1').style.display = "none";
 	document.getElementById("pass1").style.backgroundColor = "";
  	document.getElementById("pass1").style.color = "black";
	return true;
}

function validPass2(){
	var x=document.forms["newUserForm"]["pass1"].value;
	var y=document.forms["newUserForm"]["pass2"].value;
	if(x != y){
		document.getElementById('badPass2').style.display = "";
		document.getElementById("pass2").style.backgroundColor = "#CC3300";
		document.getElementById("pass2").style.color = "black";
		return false;
	}
	document.getElementById('badPass2').style.display = "none";
 	document.getElementById("pass2").style.backgroundColor = "";
  	document.getElementById("pass2").style.color = "black";
	return true;
}

/********** Switching between regular login and create new user */
function showNewUser(){
	document.getElementById('login').style.display = "none";
	document.getElementById('newUser').style.display = "";
}

function showLogin(){
	document.getElementById('login').style.display = "";
	document.getElementById('newUser').style.display = "none";
}

/*************************SEARCH***********************************/
function linkSearch(x){
	document.getElementById('search').value = x;
	testloadXMLDoc();
	return false;
}
function testloadXMLDoc(){
//hide and unhide the appropriate div tags for displaying search results
document.getElementById('banform').style.display = "none";
document.getElementById('selectSubmissionForm').style.display = "none";
document.getElementById('searchResults').style.display = "block";
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById('searchResults').innerHTML=xmlhttp.responseText;
    }
  }
 var url = "search.php?search="+document.getElementById('search').value
xmlhttp.open("GET",url + "&isSearch=true", true);
xmlhttp.send();
}

function showSubmission(){
//hide and unhide the appropriate div tags for displaying search results
document.getElementById('banform').style.display = "none";
document.getElementById('selectSubmissionForm').style.display = "none";
document.getElementById('searchResults').style.display = "block";
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById('searchResults').innerHTML=xmlhttp.responseText;
    }
  }
 var url = "submit.php"
xmlhttp.open("GET",url, true);
xmlhttp.send();
}


function viewSubmissions(){
//hide and unhide the appropriate div tags for displaying search results
document.getElementById('banform').style.display = "none";
document.getElementById('selectSubmissionForm').style.display = "none";
document.getElementById('searchResults').style.display = "block";
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById('searchResults').innerHTML=xmlhttp.responseText;
    }
  }
 var url = "submitted.php"
xmlhttp.open("GET",url, true);
xmlhttp.send();
}

function displayDetails(id){
	//hide and unhide the appropriate div tags for displaying search results
	document.getElementById('banform').style.display = "none";
	document.getElementById('selectSubmissionForm').style.display = "none";
	document.getElementById('searchResults').style.display = "block";
	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
	{
		document.getElementById('searchResults').innerHTML=xmlhttp.responseText;
    }
	}
	var url = "showPage.php?id="+id;
	//alert(url);
	xmlhttp.open("GET",url, true);
	xmlhttp.send();
}

function upVote(id){
	//alert(id);
		//hide and unhide the appropriate div tags for displaying search results
	document.getElementById('banform').style.display = "none";
	document.getElementById('selectSubmissionForm').style.display = "none";
	document.getElementById('searchResults').style.display = "block";
	//document.getElementById('popular').style.display = "block";
	document.getElementById('down' + id).style.display = "none";
	document.getElementById('up'+id).style.display = 'none';
	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
	{
		document.getElementById('popular').innerHTML=xmlhttp.responseText;
    }
	}
	var url = "upVote.php?id="+id;
	//alert(url);
	xmlhttp.open("GET",url, true);
	//testloadXMLDoc(); //to have the vote count update instantly
	xmlhttp.send();
	
}

function downVote(id){
	//alert(id);
		//hide and unhide the appropriate div tags for displaying search results
	document.getElementById('banform').style.display = "none";
	document.getElementById('selectSubmissionForm').style.display = "none";
	document.getElementById('searchResults').style.display = "block";
	document.getElementById('down' + id).style.display = "none";
	document.getElementById('up'+id).style.display = 'none';
	var xmlhttp;
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
	if (xmlhttp.readyState==4 && xmlhttp.status==200)
	{
		document.getElementById('popular').innerHTML=xmlhttp.responseText;
    }
	}
	var url = "downVote.php?id="+id;
	xmlhttp.open("GET",url, true);
	//testloadXMLDoc(); //to have the vote count update instantly
	xmlhttp.send();
}

function showNextPage(){
//hide and unhide the appropriate div tags for displaying search results
document.getElementById('test').style.display = "none";
document.getElementById('selectSubmissionForm').style.display = "none";
document.getElementById('searchResults').style.display = "none";
alert("it gets here");
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById('searchResults').innerHTML=xmlhttp.responseText;
    }
  }
 var url = "search.php?search="+document.getElementById('search').value
xmlhttp.open("GET",url + "&isSearch=false&page=next", true);
xmlhttp.send();
}

/*************************BAN**************************************/
function showBanForm() {
	document.getElementById('searchResults').style.display = "none";
	document.getElementById('selectSubmissionForm').style.display = "none";
	document.getElementById('banform').style.display = "block";
}

function updateBanForm() {
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById('banform').innerHTML=xmlhttp.responseText;
    }
  }

var user = document.getElementById('banTextbox').value;
var choice = getRadioVal('btngroup');
xmlhttp.open("GET", "ban_new.php?user=" + user + "&choice=" + choice, true);
xmlhttp.send();
}

function getRadioVal(radioName) {
    	var buttons = document.getElementsByName('btngroup');
    	for (var count = 0; count < buttons.length; count++) {
      		if(buttons[count].checked) {
        		return buttons[count].value; 
       	}
    	}
}

/******************SUBMISSION EDITING***********************************/

function showSelectSubmissionForm() {
	document.getElementById('searchResults').style.display = "none";
	document.getElementById('banform').style.display = "none";
	document.getElementById('selectSubmissionForm').style.display = "block";
}

function updateSelectSubmissionForm() {
	var xmlhttp;
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
  	} else {// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	xmlhttp.onreadystatechange=function() {	
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	    		document.getElementById('selectSubmissionForm').innerHTML=xmlhttp.responseText;
    		}
  	}
	
	//var id = document.getElementById('IDTextbox').value;
	//xmlhttp.open("GET", "selectSubmission.php?id=" + id, true);
	xmlhttp.open("GET", "selectSubmission.php", true);
	xmlhttp.send();
}


function showEditForm(id, errorMessage) {
	var xmlhttp;
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
  	} else {// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	xmlhttp.onreadystatechange=function() {	
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	    		document.getElementById('selectSubmissionForm').innerHTML=xmlhttp.responseText;
    		}
  	}

xmlhttp.open("GET", "edit.php?id=" + id + "&error=" + errorMessage, true);
xmlhttp.send();


}
function updateEditForm() {
	var title = document.getElementById('editTitle').value;
	var articleurl = document.getElementById('editArticleURL').value;
	var tags = document.getElementById('editTags').value;
	var review = document.getElementById('editReview').value;
	var imgurl = document.getElementById('editURL').value;
	var id = document.getElementById('articleID').value;
	
	if(title == "" || articleurl == "" || tags == "" || review == "") {
		showEditForm(id, 1);
		return;
	}

	var xmlhttp;
	if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
  	} else {// code for IE6, IE5
  		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  	}
	xmlhttp.onreadystatechange=function() {	
		if (xmlhttp.readyState==4 && xmlhttp.status==200) {
	    		document.getElementById('selectSubmissionForm').innerHTML=xmlhttp.responseText;
    		}
  	}
	
	
	var post="title=" + title + "&articleurl=" + articleurl + "&tags=" + tags + "&review=" + review + "&imgurl=" + imgurl + "&id=" + id;
	xmlhttp.open("POST", "edit_db.php", true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(post);
}