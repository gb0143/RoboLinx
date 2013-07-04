<?php
	include_once('CommonMethods.php');
	$COMMON = new Common($debug);//common methods
	//$tag=$_GET["q"];
	$search = mysql_real_escape_string($_GET["search"]);
	//echo($search);
	//$search = "ipod";
	if($_GET['isSearch']){
		$start = 0;
		$_SESSION['page'] = 1;
		$sql="SELECT COUNT(*) FROM robo_links WHERE tags like '%".$search."%' OR
		Title like '%".$search."%' OR Review like '%".$search."%'";
		$results = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
		$test = $results[0][0];
		$row = mysql_fetch_array($results);
		echo($row[0]);
	}else{
		$start = (int)$_SESSION['page'] * 15 - 15;
	}
	//$start = 0;
	$sql="SELECT `ID`,`Submitter`,SUBSTRING(`Title`,1,40) as Title,`Url`,`views`,`Rating`,`Tags`,SUBSTRING(`Review`,1,120) as Review,
		`pic_url`,`DateAdded` FROM `robo_links` WHERE tags like '%".$search."%' OR
		Title like '%".$search."%' OR Review like '%".$search."%' ORDER BY `DateAdded` DESC LIMIT ".$start." , 15";
	//echo($sql);
	$results = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	echo("<h3 id='results'>Results:</h3>");
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
	
?>