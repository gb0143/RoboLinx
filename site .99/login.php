<?php
	error_reporting(0);
	$username = $_POST[fname];
	$password = $_POST[pass];
	$login = false;
	include('CommonMethods.php');
	$COMMON = new Common($debug);//common methods
	//$debug = false;
	$query = "SELECT * FROM  `robo_users` WHERE  `User_Name` =  '".mysql_real_escape_string($username)."'";
	//echo($query);
	$user = $COMMON->executeQuery($query, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_assoc($user);
	//print_r($row);
	//echo(md5($password));
	//print_r($row);
	if($row['Blocked'] == 1){
		echo("<script language='javascript'>alert('You have been blocked!');</script>");
		echo("<script language='javascript'>window.history.back(-1);</script>");
		$username = "";
	}
	if(($row['User_Name'] == $username ) AND ($username != "")
		AND ($row['Password'] == md5($password))) {
			//echo($row['Password']."       ".md5($password));
			$login = true;
			session_start();
			//store session data
			$_SESSION['user'] = $username;
			$_SESSION['loggedIn'] = '1';
			$_SESSION['type'] = $row['Type'];
			//echo("<script language='javascript'>alert('Valid Login Information');</script>");
	}else{
		$_SESSION['loggedIn'] = '0';
		echo("<script language='javascript'>alert('Invalid Login Information');</script>");
	}
	echo("<script language='javascript'>window.history.back(-1);</script>");
?>