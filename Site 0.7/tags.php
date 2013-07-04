<?php
	include('CommonMethods.php');
	$COMMON = new Common($debug);//common methods
	$tag=$_GET["q"];

	$sql="SELECT TagName FROM robo_tags";

	$result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);

	$i = 0;
	$tags = array();
	while($row = mysql_fetch_array($result))
	{
		array_push($tags, $row[0]);
	}
	echo json_encode($tags );
	
?>