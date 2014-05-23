<?php
  session_start();
  require_once "header.php";
     
if (isset($_SESSION['logged_in_user'])) {   

  ?>
 
 <div class="bg">
	<div class="container">
          
 <header>
    <div class="headercontent">
    <p>MAIN MENU</p>
    
   <a id="right-menu" href="#right-menu"><span class="right"><img src="images/settings.png" alt="settings" width="27" height="35"></span></a>

 
<div id="sidr-right">
  <ul>
    <li><a href="editprofile.php">Edit Profile</a></li>
    <li><a href="logout.php">Log Out</a></li>
  </ul>

    </div>
 </header>
 
 <div class="mainmenu">
  
  <ul>
    <li><a href="createsubject.php"><img src="images/add-icon.png" alt="Create Decks" width="25" height="25" class="deck">Create Decks</a></li>
    <li><a href="mydecks.php"><img src="images/deck-icon.png" alt="My Decks" width="25" height="25" class="deck">My Decks</a></li>
    <li><a href="finddecks.php"><img src="images/search-icon.png" alt="Find Decks" width="25" height="25" class="deck">Find Decks</a></li>
  </ul>
 </div>
 
 
 
 
 
<?php

} else {
  require_once "index.php";
}
require_once "foot.php";
?>