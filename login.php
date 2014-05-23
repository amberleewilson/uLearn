<?php


      if (!isset($_POST['username'])) {
        header('Location: index.php');
        exit;
    } else { 
        if ($_POST['username'] === '' && $_POST['password'] === '' ) { //is the username and password an empty string
            header('Location: ' . $_POST['from_page'] . '?error=userpass'); //will redirect them back to where they were with error userpass
            exit;
        } else if ($_POST['password'] === '') {
            header('Location: ' . $_POST['from_page'] . '?error=pass');
            exit;
        } else if ($_POST['username'] === '') {
             header('Location: ' . $_POST['from_page'] . '?error=user');
            exit;
        }
    }
    
    require_once 'includes/MySQL.php';
    require_once 'includes/db.php';
    
    
	$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
        
        $valid_user = false;
        
        $sql = "SELECT username, password, salt FROM users WHERE username=?";
        
        $stm = $db->dbConn->prepare($sql);

	$stm->execute(array(trim($_POST['username'])));

	$result = $stm->fetchAll();
	
	if ($stm->rowCount() === 1) {

		foreach ($result as $row) {
                    
        $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
			for($round = 0; $round < 65535; $round++) { 
		     $check_password = hash('sha256', $check_password . $row['salt']); 
			}
		
			if($check_password === $row['password'])
                        
                     $valid_user = true; 
					session_start();
                                        
        $_SESSION['logged_in_user'] = $row['username'];
					
					header('Location: mainmenu.php');
                }
                }
                                        
    if (!$valid_user) {	//	no valid user was found?
		header('Location: index.php?error=invalid');	//	####	RETURN TO HOMEPAGE WITH ERROR in query string
	}
                
?>
        
        
    