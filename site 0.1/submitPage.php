<?php
	error_reporting(0);
	$title = $_POST[title];
	$url = $_POST[url];
	$tags = $_POST[tags];
	include('CommonMethods.php');
	$COMMON = new Common($debug);//common methods
	if($title != ""){
		$query = "INSERT INTO `robo_links` (`Title`, `Url`,`Tags`) 
		VALUES ( '".mysql_real_escape_string($title)."', 
			    '".mysql_real_escape_string($url)."', 
			    '".mysql_real_escape_string($tags)."')";


		
		$COMMON->executeQuery($query, $_SERVER["SCRIPT_NAME"]);
	}
?>

<html>
	<head>
		<title>Login as Regular User </title>
		<link rel="stylesheet" type="text/css" href="layout.css">
	</head>
	<body>
		<form action="regUserLogin.php" method="post">
			Title: <input type="text" name="title" />
			<br />
			URL: <input type="text" name="url" />
			<br />
			Tags (Seperated by commas): <input type="text" name="tags" />
			<br />
			Rating: 
			<input type="submit" />
		</form>
	</body>
</html>