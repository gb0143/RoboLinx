<?php
	include_once('CommonMethods.php');
	$COMMON = new Common($debug);//common methods
	//$tag=$_GET["q"];
	$id = mysql_real_escape_string($_GET["id"]);
	//echo($search);
	//print_r($_GET);
	echo("<script src='validate.js'></script>");
	
	$sql="SELECT `ID`,`Submitter`, Title,`Url`,`views`,`Rating`,`Tags`,Review,
		`pic_url`,`DateAdded` FROM `robo_links` WHERE `ID` = ".$id;
	//echo($sql);
	$results = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	echo("<h3 id='results'></h3>");
	echo("<ul>");
	$i = 0;
	$tags = array();
	while($row = mysql_fetch_array($results))
	{
			echo("<a STYLE='TEXT-DECORATION: NONE' href='".$row['Url']."' target='_blank' ><h1><u>".$row['Title']."</u></h1></a>");
			echo("<img src='".$row['pic_url']."' width='100%'>");
			echo("<p><font color = black>".$row['Review']."</font></p>");
			echo("<p align='right'><font color = black>".$row['DateAdded']."</font></p>");
			$sql="UPDATE `robo_links` SET `views` = '".((int)$row['views'] + 1)."' WHERE ID = '".$id."'";
			$COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	}
	echo("</ul>");
	echo("Click <a href = # onClick = 'testloadXMLDoc()'>here</a> to return to previous page");
?>