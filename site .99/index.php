<?php
	session_start();
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>RoboNews</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<script src="validate.js"></script>

	
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css" /></script>
	
	
  
	<script>
		$(function(){
		var availableTags = <?php include 'tags.php'; ?>;
			$( "#search" ).autocomplete({
				source: availableTags
			});
		});
	</script>
  
  
</head>
<body>
	
	<div class="background">
		<div class="page">
			<div class="header">
				<a href='index.php' id="logo"><img src="images/logo.png" alt="logo"></a>
					<ul>
					<?php
						//include_once("CommonMethods.php");
						//$COMMON = new Common(false);
						$sql="SELECT `TagName` FROM `robo_tags` ORDER BY `Count` DESC LIMIT 0,5";
						$results = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
						//echo($sql);
						while($row = mysql_fetch_array($results)){
							echo("<li><a onClick= linkSearch('".$row[0]."') href='#'>".$row[0]."</a></li>");
						}
					?>
				</ul>
			</div>
			<div class="body home">
				<div>
					<div>
						<div id="popular" style='display:none'>
						<ul>

						</ul>
						</div>
	<!-- DIV TAG FOR BAN FORM -->
						<div id='banform' style="display:none">
							<p> Enter the username of the user to ban.  Usernames can be found in the table below.</p>
							<form name="banForm" onsubmit="updateBanForm(); return false;">
								<input type='text' name='tbBanUser' size='25' id='banTextbox'>
								<input type='submit' name='BanButton' value='Submit'><br>
								<input type='radio' name='btngroup' value='ban' checked>Ban<br>
								<input type='radio' name='btngroup' value='unban'>Unban
								
							</form><br>

							<?php
								//display a table of all users
								$sql = "select * from robo_users where Type = '0' order by User_Name asc";
								$rs = $COMMON->executeQuery($sql, null);

								echo("<table border='1'>");
								echo("<tr><th>Username</th><th>Email</th><th>Banned</th></tr>");
								for ($count = 0; $count < mysql_num_rows($rs); $count++) {
							    	$row = mysql_fetch_array($rs);
							    	echo("<tr><td>".$row[User_Name]."</td><td>".$row[Email]."</td><td>".$row[Blocked]."</td></tr>");
								}
								echo("</table>");
							?>
							
						</div>
	<!-- DIV TAG FOR SUBMISSION SELECTION FORM -->
						<div id='selectSubmissionForm' style='display:none'>
							<?php
								//display the table of all articles
								//admin users see all articles, reg users only see articles 
								//that they submitted
								include("selectSubmission.php");
							?>
						</div>
						<div id="searchResults" style='display:'>
	<!--ONLY WORKS WITH 15 RESULTS... CHANGE TO FIX!!!!!!!!!!!!!!!!!!!!!!!!!!-->
							<?php include 'no_search.php'; ?>
						</div>
					</div>
				</div>
				<div class="sidebar">
				
				<div id='' class = 'search'>
					<span>
						<form method="post" onSubmit="testloadXMLDoc(); return false;">
							<input onClick="this.value = '';" id="search" name="search" value='' type = 'text' style="font-size: 15pt; width:170px; padding: 0 0 0 0;"/>
							<INPUT TYPE="image" SRC="images/searchicon.png" width=25 /> 
						</form>
					</span>
				</div>
				
				<hr color='black' />
				<div id='newUser' style='display:none' class='login'>
					<span>Create User</span>
					<ul>
					<form onsubmit="return validNForm()" method="post" name="newUserForm" action="newUser.php">
							<div id='badEMail' style="display:none"><font color= 'red'>Invalid e-mail address<br /></font></div>
							<li><font color = white>E-Mail: </font><br /><input id = "eMail" type="text" name="eMail" onchange="validEMail()"></li>
							<div id='badUserName' style="display:none"><font color= 'red'>Username must be at least 6 characters<br /></font></div>
							<li><font color = white>Username: </font><br /><input id = "uname" type="text" name="uname" onchange="validUName()"></li>
							<div id='badPass1' style="display:none"><font color= 'red'>Password must be at least 6 characters<br /></font></div>
							<li><font color = white>Password: </font><br /><input id = "pass1" type="password" name="pass1" onchange="validPass1()"></li>
							<div id='badPass2' style="display:none"><font color= 'red'>Both passwords do not match<br /></font></div>
							<li><font color = white>Re-type Password: </font><br /><input id = "pass2" type="password" name="pass2" onchange="validPass2()"></li>
							<li><input type = submit value = "Create"></li>
					</form>
					<a href="#" onclick="showLogin();">Login</a>
					</ul>
				</div>
				<?php
					if($_SESSION['loggedIn'] != '1' && $_SESSION['newUser'] != '1'){
						echo("<div id='login' class='login'>");
					}else{
						echo("<div id='login' style='display:none' class='login'>");
					}
				?>
					<span>Sign In </span>
					<ul>
						<form name="loginForm" action="login.php" onsubmit="return validLForm();" method="post">
							<div id='badLogin' style="display:none"><font color= 'red'>Invalid Information<br /></font></div>
							<div id='badName' style="display:none"><font color= 'red'>Username must be 6 characters long<br /></font></div>
							<li><font color = white>Username: </font><input id = "fname" type="text" name="fname" onchange="validName()"></li>
							<div id='badPass' style="display:none"><font color= 'red'>Password must be 6 characters long<br /></font></div>
							<li><font color = white>Password: </font><input id = "pass" type="password" name="pass" onchange="validPass()"></li>
							<li><input type="submit" value="Submit"></li>
							<a href="#" onclick="showNewUser();">New User</a>
						</form>
					</ul>
					</div>
					<?php
					if($_SESSION['loggedIn'] == '1' && $_SESSION['type'] == 1){
						echo("<div class='news'>");
					} else {
						echo("<div style='display:none' class='news'>");
					}
					?>
					<span>Admin Links</span>
						<ul>
							<li>
								<a href="#" onclick="showBanForm();">Ban User</a>
							</li>
							<li>
								<a href="#" onclick="showSelectSubmissionForm();"> Edit Submission</a>
							</li>
							
						</ul>
					<a href='logout.php'>Logout?</a>
				</div>
					<?php
						if($_SESSION['loggedIn'] == '1' && $_SESSION['type'] == 0){
							echo("<div class='news'>");
						} else {
							echo("<div style='display:none' class='news'>");
						}
					?>
						<span>Account</span>
						<ul>
							<li>
								<a href = # onClick ='showSubmission()'>Submit Article</a>
							</li>
							<li>
								<a href = # onClick ='viewSubmissions()'>View My Submissions</a>
							</li>
							<li>
								<a href = # onclick = 'showSelectSubmissionForm()'>Edit My Submissions</a>
							</li>
						</ul>
							<a href='logout.php'>Logout?</a>
					</div>
					<hr color='black' />
					<div class="news">
						<span>Highest Rated:</span>
						<ul>
							<?php include 'most_popular.php'; ?>
						</ul>
					</div>
					<div class="section">
						<span>Most Viewed:</span>
						<ul>
							<?php include 'most_viewed.php'; ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer">
				<div>
					<ul>
					<?php
						$sql="SELECT `TagName` FROM `robo_tags` ORDER BY `Count` DESC LIMIT 0,5";
						$results = $COMMON->executeQuery($sql, $_SERVER["SCRIPT_NAME"]);
						//echo($sql);
						while($row = mysql_fetch_array($results)){
							echo("<li><a onClick= linkSearch('".$row[0]."') href='#'>".$row[0]."</a>|</li>");
						} 
					?>
					</ul>
					<p>
						RoboNews created by: Gaurang, Sven, Austin, Kyle, Chad
					</p>
				</div>
				<div class="connect">
					<span>Follow Us</span> <a href="http://freewebsitetemplates.com/go/facebook/" id="fb">fb</a> <a href="http://freewebsitetemplates.com/go/twitter/" id="twitter">twitter</a> <a href="http://freewebsitetemplates.com/go/googleplus/" id="googleplus">google+</a> <a href="http://www.freewebsitetemplates.com/misc/contact" id="contact">contact</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
