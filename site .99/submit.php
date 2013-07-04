<?php
	error_reporting(0);
	include('CommonMethods.php');
	$COMMON = new Common($debug);//common methods
	$debug = false;
	$submitter = $_POST[submitter];
	$title = $_POST[title];
	$url = $_POST[url];
	$tags = strtolower($_POST[tags]);   //NEED TO SPLIT!
	$review = $_POST[review];
	$pic = $_POST[pic];
	if($submitter != '' and $title != '' and $url != '' and $tags != '' and $review != '' and $pic != ''){
	$query = "
	INSERT INTO  `a5147907_Robo`.`robo_links` (
	`ID` ,
	`Submitter` ,
	`Title` ,
	`Url` ,
	`views` ,
	`Rating` ,
	`Tags` ,
	`Review` ,
	`pic_url` ,
	`DateAdded`
	)
	VALUES (
	NULL ,  '".$submitter."',  '".$title."',  '".$url."',  '0',  '0',  '".$tags."',  '".$review."',  '".$pic."', 
	CURRENT_TIMESTAMP
	);";
	echo("Article submitted");
	$COMMON->executeQuery($query, $_SERVER["SCRIPT_NAME"]);
	}else{
	//	echo("COULD NOT SUBMIT ARTICLE");
	}
	echo("<script>window.location.href = 'index.php'</script>");
?>
<head>
	<meta charset="UTF-8">
	<script src="validate.js"></script>
</head>

<html>
	<body>
	<form method = 'post' action = 'submit.php' onsubmit = 'validateSubmit()'>
		<table border = 1>
			<tr>
				<td>Username of submitter: </td>
				<td><input type = text name = 'submitter' id = 'submitter' value = '<?php session_start(); echo($_SESSION['user']) ?>'/></td>
			</tr>
			<tr>
				<td>Title of the article: </td>
				<td><textarea rows="4" cols="50" name = 'title' id = 'title' /></textarea></td>
			</tr>
			<tr>
				<td>URL of article: </td>
				<td><textarea rows="4" cols="50" name = 'url' id = 'url' /></textarea></td>
			</tr>
			<tr>
				<td>Tags(Separated by commas): </td>
				<td><textarea rows="4" cols="50" name = 'tags' id = 'tags' /></textarea></td>
			</tr>
			<tr>
				<td>Review of article: </td>
				<td><textarea rows="4" cols="50" name = 'review' id = 'review' /></textarea></td>
			</tr>
			<tr>
				<td>URL of Picture (not article!): </td>
				<td><textarea rows="4" cols="50" name = 'pic' id = 'pic' /></textarea></td>
			</tr>
		</table>
		<input type = submit>
		<input type='button' value='Cancel' onclick='testloadXMLDoc()'>
	</body>
</html>