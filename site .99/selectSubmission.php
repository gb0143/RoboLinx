<?php
	session_start();
	include_once("CommonMethods.php");
	$Common = new Common($false);
	
	//echo($sql);
	//$sql is set in index.php (in the selectSubmissionForm div tag)
	if($_SESSION[type] == 0) {
		$sql = "select * from robo_links where Submitter = '" . $_SESSION[user] . "' order by Title asc";
	} else {
		$sql = "select * from robo_links order by Title asc";
	}
	$rs = $Common->executeQuery($sql, null);
	if(mysql_num_rows($rs) == 0) {
		echo("<p><font color = red>There are no articles to edit.</font></p>");
		return;
	}
	
	echo("<p>Click on a row in the table to edit the corresponding article.</p><br>");
	echo("<table border='1'>");
	echo("<tr><th>Article Title</th><th>Submitter</th><th>Date Submitted</th></tr>");

	for($count = 0; $count < mysql_num_rows($rs); $count++) {
		$row = mysql_fetch_array($rs);
		echo("<tr onClick = 'showEditForm(".$row['ID'].", 0);'><td>" . $row[Title] . "</td><td>" . $row[Submitter] . "</td><td>" .
			$row[DateAdded] . "</td></tr>");
	}
	echo("</table>");
?>