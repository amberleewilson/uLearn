<?php
  session_start();
  require_once "header.php";
 ?>

 <?php
     
if (isset($_SESSION['logged_in_user'])) {   

  ?>
 
<div class="bg">
	<div class="container">
 <header>
    

     
    <p>ADD CARD</p>

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
 
<form action="createdeck.php" method="post" class="addcard-form">
    
<textarea name="name" cols="31" rows="20" id="name" placeholder="name" class="addcard"></textarea><br>
			
<textarea name="definition" cols="31" rows="20" id="definition" placeholder="definition" class="addcard"></textarea><br>

<input type="hidden" name="subject_id" value="<?php echo $_GET['subjectID']; ?>">

		<input type="submit" name="add-card" value="Done" class="button-2">
	</form>
    </div>

 
 
 
 
 
   </div> <!-- end of bg -->
    </div> <!-- end of container -->


<?php

} else  {
  require_once "index.php";

}



require_once "foot.php";
?>