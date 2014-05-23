<?php
  session_start();
  require_once "header.php";
  
  // This function will make sure long words are cut off after a certain length 

            function subStringWords($string, $length, $ellipse='') {
  
  $explode = explode("\n", wordwrap($string, $length));
  
    if (strlen($string) <= $length) { return $string; }
   return array_shift($explode) . $ellipse;
}
  
if (isset($_SESSION['logged_in_user'])) {   

  ?>

 
<div class="bg">
	<div class="container">
 <header>
    

      
          
    <p>FIND DECKS</p>

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
 
 <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" class="search-bar">
 
    <input type="text" name="search" placeholder="Search For a Deck"><br>
        
    <input type="submit" name="submit" value="Go" class="search-button">
    
 </form>
 
   <div class="search-table">
	<table class="deckdef search-results">
 
 <?php
 
 if (isset($_POST['submit'])) {
  
  $search = $_POST['search'];

 
require_once 'includes/MySQL.php';
require_once 'includes/db.php';

    $db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
 
   $sql = "SELECT subjectname, subjectID FROM subject WHERE subjectname LIKE '%$search%' ";
	 
	 $stm = $db->dbConn->prepare($sql);
	 	$stm->execute(array());

	$result = $stm->fetchAll();
	
	foreach ($result as $row) {
	  
	  $string = $row['subjectname'];
	  ?>
	
	  
	  <tr>
<td>
<a href="deck.php?subjectID=<?php echo $row['subjectID']; ?>"><?php echo subStringWords($string, 20); ?></a>
</td>
</tr>
	

	<?php
	
	  }
        }
?>

 
	</table>
	</div> <!-- end of table -->
         </div> <!-- end of bg -->
        </div> <!-- end of container -->


<?php

} else  {
  require_once "index.php";
}
require_once "foot.php";
?>