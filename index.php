<?php
require_once "header.php";
	
?>

<div class="container">
	
	<div class="logo"><img src="images/logo.png" alt="uLearn, a studying resource" height="170" width="245"></div>
	
	<div id="login-form">
		
	<?php
	if (!isset($_SESSION['logged_in_user'])) { 
?>

	<form action="login.php" method="post" id="login-validate">
		<label for="username"></label>
		<input type="text" name="username" id="username" value="username" class="topinput grayed-out"><br>
			
		<label for="password"></label>
		<input type="password" name="password" id="password" value="password" class="bottominput grayed-out"><br>
		
		
		<input type="submit" value="Log In" class="button">
	</form>
	</div>
	<a href="register.php">Sign Up For uLearn</a>
	
	<?php
	}
if (isset($_GET['error'])) {
		switch($_GET['error']) {
			case 'user':
				echo '<h5>Please enter a username.</h5>';
				break;
			case 'pass':
				echo '<h5>Please enter a password.</h5>';
				break;
			case 'userpass':
				echo '<h5>Please enter a username and password.</h5>';
				break;
			case 'invalid':
				echo '<h5>That username/password combination was not found.<h5>';
			
		}
	
	}

require_once "foot.php";
?>