<?php
	include_once('CommonMethods.php');
	$COMMON = new Common($debug);//common methods
	//$tag=$_GET["q"];
	session_start();
	$search = mysql_real_escape_string($_GET["search"]);
	//echo($search);
	$isSearch = $_GET['isSearch'];
	$sql="SELECT COUNT(*) FROM robo_links WHERE tags like '%".$search."%' OR
		Title like '%".$search."%' OR Review like '%".$search."%'";
	$results = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_array($results);
	$count = $row[0];
	//print_r($_GET);
	echo("<script src='validate.js'></script>");
	if($isSearch){
		$start = 0;
		$_SESSION['page'] = 1;
		$end = 15;
		if($end > $count){
			$end = $count;
		}
		
	}else if($_GET['page'] == 'next'){
		$_SESSION['page'] = $_SESSION['page'] + 1;
		$start = (int)$_SESSION['page'] * 15 - 15;
		$end = $start + 15;
		if($end > $count){
			$end = $count - $start;
		}
	}else if($_GET['page'] == 'last'){
		$_SESSION['page'] = $_SESSION['page'] + 1;
		$start = (int)$_SESSION['page'] * 15 - 15;
		$end = $start + 15;
		if($end > $count){
			$end = $count - $start;
		}
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
			echo("<a STYLE='TEXT-DECORATION: NONE' href='#' onClick = 'displayDetails(".$row['ID'].")'><img src='".$row['pic_url']."' width='200' height = '152'>");

			echo("<h4>".$row['Title']."</h4></a>");
			echo("<p><font color='white'>".$row['Review']."</font></p>");
			if($_SESSION['loggedIn'] == '1'){
			echo("<p align = left><img id = 'up".(int)$row['ID']."' src = images/upvote.png width = 10 onClick = 'upVote(".$row['ID'].")'/>&nbsp;&nbsp;&nbsp;&nbsp");
			if((int)$row['Rating'] > 0){
				echo("<font color = green >".(int)$row['Rating']."</font>");
			}else if((int)$row['Rating'] < 0){
				echo("<font color = red >".(int)$row['Rating']."</font>");
			}else{
				echo("<font color = white >".(int)$row['Rating']."</font>");
			}
			echo("&nbsp;&nbsp;&nbsp;&nbsp;<img id = 'down".(int)$row['ID']."' src = images/downvote.png width = 10 onClick = 'downVote(".$row['ID'].")'/>&nbsp;&nbsp;&nbsp;&nbsp;");
			}
			echo("<font color = white Align=right>".$row['DateAdded']."</font></p>");
		echo("</li>");
	}
	echo("</ul>");
	
	echo("<center><table border = 0 valign='middle'><tr>");
	if($start != 0){
		echo("<td><a href = '#'><img onclick='showPreviousPage();' src='images/left_arrow.png' width = 40px/></a></td>");
	}
	echo("<td style = 'vertical-align:middle;'><font size = 5px>".$start." to ".$end." of <u>".$count."</font></u></td>");
	if($end < $count){
		echo("<td><a href = '#' onClick='showNextPage();'><img  src='images/right_arrow.png' width = 40px/></a></td>");
	}
	echo("</tr></table></center>");
?>