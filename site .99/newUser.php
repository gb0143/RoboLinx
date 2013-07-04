<?php
	error_reporting(0);
	$username = $_POST[uname];
	$password = $_POST[pass2];
	$Email = $_POST[eMail];
	//echo($username);
	//echo($password);
	//echo($Email);

	include('CommonMethods.php');
	$COMMON = new Common($debug);//common methods
	$debug = false;
	$query = "select count(*) from robo_users where User_Name = '".mysql_real_escape_string($username)."'";
	$numQs = $COMMON->executeQuery($query, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_array($numQs);
	$error = "";
	$tab = "&#160;&#160;&#160;&#160;&#160;&#160;&#160;";
	
	if($row[0] > 0){
		echo("<script language='javascript'>alert('Username already exists');</script>");
	}else{
		$query = "INSERT INTO `a5147907_Robo`.`robo_users` (`Email`, `User_Name`, `Password`, `Type`) 
		VALUES ('".mysql_real_escape_string($Email)."', '".mysql_real_escape_string($username)."', '".md5(mysql_real_escape_string($password))."', '0');";
		//echo($query);
		$COMMON->executeQuery($query, $_SERVER["SCRIPT_NAME"]);
		echo("<script language='javascript'>alert('Account Created');</script>");
		$_SESSION['user'] = $username;
		$_SESSION['loggedIn'] = '1';
	}
	echo("<script language='javascript'>window.history.back(-1);</script>");
?>