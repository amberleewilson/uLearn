<?php
  session_start();
  require_once "header.php";

if (isset($_SESSION['logged_in_user'])) {   

 ?>
 
<div class="bg">
	<div class="container">
 <header>
    

        
     <a href="javascript:history.go(-1)"><span class="left"><img src="images/arrow.png" alt="go back" width="31" height="22"></span></a>
          
    <p>CREATE DECKS</p>

    <a id="right-menu" href="#right-menu"><span class="right"><img src="images/menu.png" alt="menu" width="29" height="27"></span></a>

 
<div id="sidr-right">
  <ul>
      <li><a href="mainmenu.php">Main Menu</a></li>
    <li><a href="createsubject.php">Create Decks</a></li>
    <li><a href="mydecks.php">My Decks</a></li>
        <li><a href="finddecks.php">Find Decks</a></li>
  </ul>

    </div>
 </header>
 
 
 
 
<form action="createdeck.php"" method="post">
<p class="white">What is the Subject of Your Deck?</p>
<input type="text" name="subjectname" class="field"><br>

<input type="submit" name="addsubject" value="Next" class="button">
    

 </form>
 
   </div> <!-- end of bg -->
        </div> <!-- end of container -->
 
 
 <?php

} else {
  require_once "index.php";
}
require_once "foot.php";
?>