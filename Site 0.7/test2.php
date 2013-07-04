<?php
	include('CommonMethods.php');
	$COMMON = new Common($debug);//common methods
	$tag=$_GET["q"];
	$search = $_GET["search"];
	//echo($search);
	//$search = "ipod";
	$sql="SELECT `ID`,`Submitter`,SUBSTRING(`Title`,1,40) as Title,`Url`,`views`,`Rating`,`Tags`,SUBSTRING(`Review`,1,120) as Review,
		`pic_url`,`DateAdded` FROM `robo_links` WHERE tags like '%".$search."%' OR
		Title like '%".$search."%' OR Review like '%".$search."%'";
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
		
		echo("<li>");
			echo("<a href='".$row['Url']."'><img src='".$row['pic_url']."' width='200' height = '152'></a>");
			echo("<h4>".$row['Title']."</h4>");
			echo("<p>".$row['Review']."</p>");
		echo("</li>");
	}
	echo("</ul>");
	
?>