<?php

	session_start();
	
		function show_alert($valid) {
		if (!$valid) {
			
		}
	} 

	
	// form validation
	
	$all_valid = $username_valid = $email_valid = $password_valid = $password2_valid = $password_match_valid = true;
	
	$username_exists = false;
	
	$reg_error_message = ''; //variable for error message
	
	$reg_success_message = ''; //variable for success message
	
	if (isset($_POST['register'])) { //**
		
	require_once 'EmailAddressValidator.php';
	
	$validator = new EmailAddressValidator();
	
		if ($_POST['username'] == '') {
			$all_valid = $username_valid = false;
		}
		
		if (!$validator->check_email_address($_POST['email'])) {
			$all_valid = $email_valid = false;
		}
		
		if ($_POST['password'] == '') {
			$all_valid = $password_valid = false;
		}
		
		if ($_POST['password2'] == '') {
			$all_valid = $password2_valid = false;
		}
		
		if ($_POST['password'] != $_POST['password2']) {
			$all_valid = $password_match_valid = false;
		}
		
	if ($all_valid) {
	
	require_once 'includes/MySQL.php';
	
	require_once 'includes/db.php';
	
	$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
	
	$sql = "SELECT userID FROM users WHERE username=?";
	
	$stm = $db->dbConn->prepare($sql);
	
	$stm->execute(array(trim($_POST['username'])));
	
	$result = $stm->fetchAll();
	
	if ($stm->rowCount() === 1) {
		
	$username_exists = true;
	
	$reg_error_message = '<h5>Sorry, that username is taken!</h5>';
				$all_valid = false;
	} else {
		
		 $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
		 
		   $password = hash('sha256', $_POST['password'] . $salt);
		   
		    for($round = 0; $round < 65535; $round++) { 
		            $password = hash('sha256', $password . $salt); 
		        
		 
	}
	
	$sql = "INSERT INTO users (
				username,
				email,
				password,
				salt
				) VALUES (
					?,
					?,
					?,
					?)";

 $stm = $db->dbConn->prepare($sql);
 
 $stm->execute(array($_POST['username'],
			$_POST['email'],
			$password,
			$salt));
 
 $reg_success_message = '<div class="register-success"><p class="welcome">Success!<p><br>
 <form action="index.php" method="post"><input type="submit" value="Continue To Login" class="button"></form></div>';
	}}}
 	
	require_once('header.php');
     
     
     
     ?>
     
   <div class="container">
	
	
<?php if ($reg_success_message == '') { // if register hasnt been successfull bring the user to the form
	?>

   <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="register-form" id="register-validate">
   
			<p class="white">Account</p>
   
		<label for="username"></label>
		<input type="text" name="username" id="username" placeholder="username" class="topinput"></br>
			
		<label for="email"></label>
		<input type="email" name="email" id="email" placeholder="email" class="forminput"><br>
		
		<label for="password"></label>
		<input type="password" name="password" id="password" placeholder="password" class="forminput"><br>
		
		<label for="password2"></label>
		<input type="password" name="password2" id="password2" placeholder="confirm password"  class="bottominput"><br>
		
		
		<input type="submit" name="register" value="Register" class="button">
	</form>
	
	<?php 	show_alert($username_valid); ?><? echo $reg_error_message;
		show_alert($email_valid);
		if (!$all_valid && !$password_match_valid) echo '<h5>Passwords must match!</h5>';
		
		

	 } else { echo $reg_success_message;
	 
	 }
	 
	
require_once "foot.php";
?>

	

   
