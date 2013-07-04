<?php
	include_once('CommonMethods.php');
	$COMMON = new Common($debug);//common methods
	//$tag=$_GET["q"];
	session_start();
	$search = mysql_real_escape_string($_GET["search"]);
	//echo($search);
	$isSearch = $_GET['isSearch'];
	echo($sql);
	$sql="SELECT COUNT(*) FROM robo_links WHERE Submitter = '".$_SESSION['user']."'";
	$results = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_array($results);
	$count = $row[0];
	//echo($sql);
	if($count != 0){
		
	//print_r($_GET);
	echo("<script src='validate.js'></script>");
	//$start = 0;
	$sql=$sql="SELECT `ID`,`Submitter`,SUBSTRING(`Title`,1,40) as Title,`Url`,`views`,`Rating`,`Tags`,SUBSTRING(`Review`,1,120) as Review,
		`pic_url`,`DateAdded` FROM `robo_links` WHERE Submitter = '".$_SESSION['user']."' ORDER BY `DateAdded` DESC LIMIT 0 , 15";
	//echo($sql);
	$results = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	echo("<h3 id='results'>Your submissions:</h3>");
	echo("<ul>");
	$i = 0;
	$tags = array();
	while($row = mysql_fetch_array($results))
	{
		if($i%3 == 0){
			echo("<ul>");
		}
		if($i%3 == 0 and i > 2){
			echo("</ul>");
		}
		$i++;
		
		echo("<li style='background:black'>");
			echo("<a STYLE='TEXT-DECORATION: NONE' href='".$row['Url']."' target='_blank' ><img src='".$row['pic_url']."' width='200' height = '152'>");
			echo("<h4>".$row['Title']."</h4></a>");
			echo("<p><font color = white>".$row['Review']."</font></p>");
			echo("<p align='right'><font color = white>".$row['DateAdded']."</font></p>");
		echo("</li>");
	}
	echo("</ul>");
	echo("<center><table border = 0 valign='middle'><tr>");
	}else{
		echo("<h3 id='results'>You have not submitted any articles...</h3>");
	}
?>