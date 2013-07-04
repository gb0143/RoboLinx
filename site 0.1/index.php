<?php
 require($DOCUMENT_ROOT . "frameTop.html");
?>

	<form action="regUserLogin.php" method="post">
		Username: <input type="text" name="username" />
			<br />
		Password: <input type="password" name="password" />
			<br />
		<input type="submit" />
	</form>
	Dont have an account?<br />Click <a href = newUser.php><b>here</b></a> to create one.
<?php
 require($DOCUMENT_ROOT . "frameBottom.html");
?>