<?php
	error_reporting(0);
	$username = $_POST[username];
	$password = $_POST[password];
	$pass2 = $_POST[retype_password];
	$cancreate = true;
	
	include('CommonMethods.php');
	$COMMON = new Common($debug);//common methods
	$debug = false;
	$numQs = 0;
	$query = "select count(*) from robo_users where User_Name = '".mysql_real_escape_string($username)."'";
	$numQs = $COMMON->executeQuery($query, $_SERVER["SCRIPT_NAME"]);
	$row = mysql_fetch_array($numQs);
	$error = "";
	$tab = "&#160;&#160;&#160;&#160;&#160;&#160;&#160;";
	
	if($username == ""){
		$cancreate = false;
	}
	
	if($password == ""){
		$cancreate = false;
	}
	
	if($username != ""){
		if($row[0] > 0){
			$error = $error."The username already exists<br />";
			$cancreate = false;
		}
		if(($password != $pass2) AND ($password != "") AND ($pass2 != "")){
			$error = $error."The Passwords do not match<br />";
			$cancreate = false;
		}
	}
	
	echo($error);
	if($cancreate){
		$query = "INSERT INTO `gb4`.`robo_users` (`User_Name`, `Password`, `Type`) 
		VALUES ('".mysql_real_escape_string($username)."', '".mysql_real_escape_string($password)."', '0')";
		$COMMON->executeQuery($query, $_SERVER["SCRIPT_NAME"]);
		header( 'Location: regUserLogin.php' ) ;
	} else if($username != ""){
		echo('<font color = red>Please enter a password</font>');
	}
?>

<?php
 require($DOCUMENT_ROOT . "frameTop.html");
?>
		<form action="newUser.php" method="post" onSubmit = "return validForm()">
			<table>
			<tr><td>Email:</td>
			<td>
			<span id='badEmail' style="display:none"><font color= 'red'>Invalid Email Address<br /></font></span>
			<input type="text" name="Email" id = "email" onchange="validEmail()"/></td>
			</tr>
			<tr><td>Username:</td>
			<td><input type="text" id = "uname" name="uname" onchange="validUName()"/></td>
			</tr>
			<tr><td>Password:</td> 
			<td><input type="password" name="password" /></td>
			</tr>
			<tr><td>Re-Type Password:</td> <td><input type="password" name="retype_password" /></td>
			</tr>
			<tr><td>
			<input type="submit" />
			</td>
			</tr>
			</table>
		</form>
<?php
 require($DOCUMENT_ROOT . "frameBottom.html");
?>
<?php include('footer.php'); ?>