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
    <li><a href="#">Edit Profile</a></li>
    <li><a href="logout.php">Log Out</a></li>
  </ul>

    </div>
 </header>




 <?php

} else  {
  require_once "index.php";
}
require_once "foot.php";
?>