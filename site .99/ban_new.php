<?php
include_once("CommonMethods.php");
$Common = new Common(false);
set_magic_quotes_runtime(0);

//check if a username was entered and ban them.
if (isset($_GET[user])) {
    $username = $_GET[user];
    $query = "select * from robo_users where User_Name = '".mysql_real_escape_string($username). "' and Type = '0'";
    $rs = $Common->executeQuery($query, null);
	$userFound = 1;
    if (mysql_num_rows($rs) == 0) {
		$userFound = 0;
    } else {
	if($_GET[choice] == 'ban') {
       	$query = "update robo_users set Blocked = '1' where User_Name = '" . mysql_real_escape_string($username) . "'" . "and Type = '0'";
	} else {
		$query = "update robo_users set Blocked = '0' where User_Name = '" . mysql_real_escape_string($username) . "'" . "and Type = '0'";
	}
        $Common->executeQuery($query, null);
    }
} 

//redisplay the form
echo("<p> Enter the username of the user to ban.  Usernames can be found in the table below.</p>
<form name='banForm' onsubmit='updateBanForm(); return false;'>");

if($userFound == 0){
	echo("<font color='red'>User Not Found</font><br />");
}

echo("<input type='text' name='tbBanUser' size='25' id='banTextbox'>
<input type='submit' name='BanButton' value='Submit'><br>
<input type='radio' name='btngroup' value='ban' checked>Ban<br>
<input type='radio' name='btngroup' value='unban'>Unban

</form><br>");
							

//display a table of all users
$sql = "select * from robo_users where Type = '0' order by User_Name asc";
$rs = $Common->executeQuery($sql, null);

echo("<table border='1'>");
echo("<tr><th>Username</th><th>Email</th><th>Banned</th></tr>");
for ($count = 0; $count < mysql_num_rows($rs); $count++) {
    $row = mysql_fetch_array($rs);
    //echo("<tr><td>".$row[User_Name]."</td><td>".$row[Blocked]."</td></tr>");
	echo("<tr><td>".$row[User_Name]."</td><td>".$row[Email]."</td><td>".$row[Blocked]."</td></tr>");
}
echo("</table>");
?>