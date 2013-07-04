<?php
	//include('CommonMethods.php');
	//$COMMON = new Common($debug);//common methods
	$tag=$_GET["q"];
	$search = mysql_real_escape_string($_GET["search"]);
	//echo($search);
	//$search = "ipod";
	$sql="SELECT `ID`,`Submitter`,SUBSTRING(`Title`,1,40) as Title,`Url`,`views`,`Rating`,`Tags`,SUBSTRING(`Review`,1,120) as Review,
		`pic_url`,`DateAdded` as 'DateAdded' FROM `robo_links` WHERE 1 ORDER BY `DateAdded` DESC LIMIT 0,15";
	//echo($sql);
	$results = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	echo("<h3 id='results'>MOST RECENT:</h3>");
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
?>