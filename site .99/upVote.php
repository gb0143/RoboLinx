<?php
	include_once('CommonMethods.php');
	$COMMON = new Common($debug);//common methods
	//$tag=$_GET["q"];
	$id = mysql_real_escape_string($_GET["id"]);
	//echo($search);
	//print_r($_GET);
	echo("<script src='validate.js'></script>");
	//echo("This is fun!!!...".$id);
	
	$sql="SELECT `ID`,`Submitter`, Title,`Url`,`views`,`Rating`,`Tags`,Review,
		`pic_url`,`DateAdded` FROM `robo_links` WHERE `ID` = ".$id;
	//echo($sql);
	$results = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
	$i = 0;
	$tags = array();
	while($row = mysql_fetch_array($results))
	{	
			//echo($row['ID']);
			$sql="UPDATE `robo_links` SET `Rating` = '".($row['Rating'] + 1)."' WHERE ID = '".$id."'";
			$COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
			//echo($sql);
	}
?>