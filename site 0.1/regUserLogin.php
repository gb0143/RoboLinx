<?php
	error_reporting(0);
	$username = $_POST[username];
	$password = $_POST[password];
	$login = false;
	include('CommonMethods.php');
	$COMMON = new Common($debug);//common methods
	//$debug = false;

	$query = "SELECT * FROM  `robo_users` WHERE  `User_Name` =  '".mysql_real_escape_string($username)."'";
	//echo($query);
	$user = $COMMON->executeQuery($query, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_assoc($user);
	//print_r($row);
	if(($row['User_Name'] == $username ) AND ($username != "")
		AND ($row['Password'] == $password) 
		AND ($row['Type'] == '0')
		){
			$login = true;
			session_start();
			//store session data
			$_SESSION['user']= $username;
			header('Location:regPage.php');
	}
	else if(($row['User_Name'] == $username ) AND ($username != "")
		AND ($row['Password'] == $password) 
		AND ($row['Type'] == '1')){
			$login = true;
			
			session_start();
			//store session data
			$_SESSION['user']= $username;
			header( 'Location: adminPage.php' ) ;
	}else if(($row['User_Name'] == $username ) AND ($username != "")
		AND ($row['Password'] == $password) 
		AND ($row['Type'] == '0')
		AND ($row['Blocked'] == 1)){
		echo("<font color = red>You have been blocked, please contact an administrator to straighten things out!</font>");
	}else if($username != ""){
		$_SESSION['invalidLogin']= '1';
	}
?>

<?php
 	require($DOCUMENT_ROOT . "frameTop.html");

	if($_SESSION['invalidLogin'] == '1')
	{
		echo("<font color = red>Invalid Login Information</font>");
	}
?>

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~THIS IS THE BODY~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

	<form action="regUserLogin.php" method="post">
		Username: <input type="text" name="username" />
			<br />
		Password: <input type="password" name="password" />
			<br />
		<input type="submit" />
	</form>
	Dont have an account?<br />Click <a href = newUser.php><b>here</b></a> to create one.

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~END OF THE BODY~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<?php
 	require($DOCUMENT_ROOT . "frameBottom.html");
	include('footer.php'); 
?>