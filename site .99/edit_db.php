<?php

	session_start();
	include_once("CommonMethods.php");
	set_magic_quotes_runtime(0);
	$Common = new Common($false);
	$title = trim($_POST[title]);
	$articleurl = trim($_POST[articleurl]);
	$tags = trim($_POST[tags]);
	$review = trim($_POST[review]);
	$imgurl = trim($_POST[imgurl]);
	$id = $_POST[id];
	

	$sql = "update robo_links set Title ='" . $title . "', Url='" . $articleurl . "', Tags = '" . $tags . "', Review = '" . $review . "', pic_url = '" . $imgurl . "' where ID = '" . $id . "'";
	$Common->executeQuery($sql, null);
	
	echo("<meta http-equiv='Refresh' content='0; url=http://gb4.site40.net/index.php#'>");

?>