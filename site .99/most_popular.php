<?php
	//include('CommonMethods.php');
	//$COMMON = new Common($debug);//common methods
	$tag=$_GET["q"];

	$sql="SELECT SUBSTRING(`Title`,1,18) as Title, ID, SUBSTRING(`DateAdded`,1,10) as DateAdded  FROM robo_links ORDER BY Rating DESC Limit 0, 10";

	$result = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$i = 0;
	$tags = array();
	while($row = mysql_fetch_array($result))
	{
		echo("
		<li>
			<a href='#' onClick = 'displayDetails(".$row['ID'].")'>".$row['Title']."...</a> <span>Posted on: ".$row['DateAdded']."</span>
		</li>
		");
	}
	echo json_encode($tags );
	
?>