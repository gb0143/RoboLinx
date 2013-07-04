<?php
	session_start();
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Robot Website</title>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<script src="validate.js"></script>

	
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
	<link rel="stylesheet" href="/resources/demos/style.css" />
  
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
				<a href="index.php" id="logo"><img src="images/logo.png" alt="logo"></a>
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
								<li>
									<a href="news.html"><img src="images/featured1.jpg" alt=""></a>
									<h4>Proin pellentesque convallis sapien a congue.</h4>
									<p>
										Aliquam at neque diam. Nulla facilisi. Donec cursus lacus id urna mattis vestibulum.
									</p>
								</li>
								<li>
									<a href="news.html"><img src="images/featured2.jpg" alt=""></a>
									<h4>Lorem ipsum consectetur adipiscing elit.</h4>
									<p>
										Donec cursus lacus id urna mattis vestibulum. Turpis ac malesuada aliquet, est tellus blandit tellus, eu dignissim arcu diam non orci.
									</p>
								</li>
								<li>
									<a href="news.html"><img src="images/featured3.jpg" alt=""></a>
									<h4>Donec cursus lacus id urna mattis vestibulum.</h4>
									<p>
										Fusce sagittis, turpis ac malesuada aliquet, est tellus blandit tellus, eu dignissim arcu diam non orci.
									</p>
								</li>
							</ul>
						</div>
	<!-- NEW DIV TAG FOR BAN FORM -->
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
								echo("<tr><th>Username</th><th>Banned</th></tr>");
								for ($count = 0; $count < mysql_num_rows($rs); $count++) {
							    	$row = mysql_fetch_array($rs);
							    	echo("<tr><td>".$row[User_Name]."</td><td>".$row[Blocked]."</td></tr>");
								}
								echo("</table>");
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
							<input onClick="this.value = '';" id="search" name="search" value='search' type = 'text' style="font-size: 15pt; width:170px; padding: 0 0 0 0;"/>
							<INPUT TYPE="image" SRC="images/searchicon.png" width=25 /> 
						</form>
					</span>
				</div>
				
				<hr color='black' />
				<div id='newUser' style='display:none' class='login'>
					<span>Create User</span>
					<ul>
					<form onsubmit="return validNForm()" method="post" name="newUserForm" action="newUser.php">
							<div id='badEMail' style="display:none"><font color= 'red'>Invalid E-mail address<br /></font></div>
							<li><font color = white>E-Mail: </font><br /><input id = "eMail" type="text" name="eMail" onchange="validEMail()"></li>
							<div id='badUserName' style="display:none"><font color= 'red'>Username must be atlest 6 characters<br /></font></div>
							<li><font color = white>Username: </font><br /><input id = "uname" type="text" name="uname" onchange="validUName()"></li>
							<div id='badPass1' style="display:none"><font color= 'red'>Password must be atlest 6 characters<br /></font></div>
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
								<a href="edit.php">Edit Submission</a>
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
						<span>Settings</span>
						<ul>
							<li>
								<img src= 'images/settings.png' width = 15px /><a href="news.html">Lorem ipsum dolor sit</a>
							</li>
							<li>
								<a href="news.html">Donec condimentum</a>
							</li>
							<li>
								<a href="news.html">Nulla facilisi</a>
							</li>
							<li>
								<a href="news.html">Nunc nec sem nisi</a>
							</li>
							<li>
								<a href="news.html">Aliquam quam nulla</a>
							</li>
							<li>
								<a href="news.html">Lorem ipsum dolor sit</a>
							</li>
							<li>
								<a href="news.html">Donec condimentum</a>
							</li>
						</ul>
							<a href='logout.php'>Logout?</a>
					</div>
					<hr color='black' />
					<div class="news">
						<span>Useful Sites</span>
						<ul>
							<li>
								<a href="news.html">Lorem ipsum dolor sit</a> <span>Posted on 23 July 2023</span>
							</li>
							<li>
								<a href="news.html">Donec condimentum</a> <span>Posted on 23 July 2023</span>
							</li>
							<li>
								<a href="news.html">Nulla facilisi</a> <span>Posted on 23 July 2023</span>
							</li>
							<li>
								<a href="news.html">Nunc nec sem nisi</a> <span>Posted on 23 July 2023</span>
							</li>
							<li>
								<a href="news.html">Aliquam quam nulla</a> <span>Posted on 23 July 2023</span>
							</li>
							<li>
								<a href="news.html">Lorem ipsum dolor sit</a> <span>Posted on 23 July 2023</span>
							</li>
							<li>
								<a href="news.html">Donec condimentum</a> <span>Posted on 23 July 2023</span>
							</li>
						</ul>
						<a href="news.html">Read More</a>
					</div>
					<div class="section">
						<span>Game Schedule</span>
						<ul>
							<li>
								<a href="schedule.html">ZZTigers VS Alligaterz</a> <span>23 July 2023 @ 9AM</span>
							</li>
							<li>
								<a href="schedule.html">ZZTigers VS Ninjas</a> <span>23 July 2023 @ 9AM</span>
							</li>
							<li>
								<a href="schedule.html">ZZTigers VS Munkees</a> <span>23 July 2023 @ 9AM</span>
							</li>
							<li>
								<a href="schedule.html">ZZTigers VS Cheetaz</a> <span>23 July 2023 @ 9AM</span>
							</li>
							<li>
								<a href="schedule.html">ZZTigers VS AlienAnts</a> <span>23 July 2023 @ 9AM</span>
							</li>
						</ul>
						<a href="schedule.html">View Schedule</a>
					</div>
					<div>
						<span>Latest Tweets</span>
						<ul>
							<li>
								<p>
									<a href="#">Praesent urna odio, vehicula quis placerat nec, feugiat id purus. Proin vitae nibh in est molestie iaculis.</a>
								</p>
							</li>
							<li>
								<p>
									<a href="#">Nunc lacinia mi et quam eleifend ullamcorper scelerisque id tortor.</a>
								</p>
							</li>
							<li>
								<p>
									<a href="#">Mauris lobortis dolor ac ipsum fermentum nec placerat mauris  luctus.</a>
								</p>
							</li>
						</ul>
						<a href="http://freewebsitetemplates.com/go/twitter/">Follow @zztigers <br> on Twitter</a>
					</div>
				</div>
			</div>
			<div class="footer">
				<div>
					<ul>
						<li class="selected">
							<a href="index.html">Home</a>|
						</li>
						<li>
							<a href="news.html">News</a>|
						</li>
						<li>
							<a href="team.html">Team</a>|
						</li>
						<li>
							<a href="schedule.html">Schedule</a>|
						</li>
						<li>
							<a href="videos.html">Videos</a>|
						</li>
						<li>
							<a href="about.html">About</a>
						</li>
					</ul>
					<p>
						&#169; ZZ TIGERS 2023. All Rights Reserved
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
