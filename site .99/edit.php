<?php

	session_start();
	include_once("CommonMethods.php");
	set_magic_quotes_runtime(0);
	$Common = new Common($false);
	
	$id = $_GET[id];
	$error = $_GET[error];

	$sql ="select * from robo_links where ID = '" . mysql_real_escape_string($id) . "'";
	$rs = $Common->executeQuery($sql, null);
	$row = mysql_fetch_array($rs); 
	if($error == 1) {
		echo("<font color='red'> All fields but image URL are required.</font>");
	}
	echo("<form name='editForm' onsubmit='updateEditForm(); return false;'>");
	echo("<table><tr><td>Title</td><td><textarea name='taEditTitle' id='editTitle' rows=6 cols=50 wrap='hard'>" . $row[Title] . "</textarea></td></tr>");
	echo("<tr><td>Article URL</td><td><textarea name='taEditArticleURL' id='editArticleURL' rows=6 cols=50 wrap='hard'>" . $row[Url] . "</textarea></td></tr>");
	echo("<tr><td>Review</td><td><textarea name='taEditReview' id='editReview' rows=6 cols=50 wrap='hard'>" . $row[Review] . "</textarea></td></tr>");	
	echo("<tr><td>Tags</td><td><textarea name='taEditTags' id='editTags' rows=6, cols=50 wrap='hard'>" . $row[Tags] . "</textarea></td></tr>");		
	echo("<tr><td>Image URL</td><td><textarea name='taEditURL' id='editURL' rows=6 cols=50 wrap='hard'>" . $row[pic_url] ."</textarea></td></tr>");
	echo("<input type='hidden' id = 'articleID' value='" . $id . "'>");
	echo("</table><input type='submit' name='editFormButton' value='Submit'>");
	echo("<input type='button' value='Cancel' onclick='updateSelectSubmissionForm();'>");
	echo("</form><br>");
?>

