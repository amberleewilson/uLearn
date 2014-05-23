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
    

        
  
          
    <p>MY DECKS</p>

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
 
 <?php
 
 $subject_id = $_GET['subjectID'];
 
 require_once 'includes/MySQL.php';

    require_once 'includes/db.php';

    $db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
 
   $sql = "SELECT subjectname, subjectID FROM subject WHERE subjectID = $subject_id";
	 
	 $stm = $db->dbConn->prepare($sql);
	 
	$stm->execute(array());
	
	$result = $stm->fetchAll();
	
	foreach ($result as $row) {
      
	  ?>
	  
	  <div class="table">

	  <table class="deckname">
	  <tr>
   
	  <td><b><?php echo $row['subjectname']; ?></b></td> <!-- subject name -->
	  </tr> 
	  </table>
	  
	  <table class="deckdef">
  <tr class="grayed-out">
    <td>Add Card</td>
    <?php
	} // end of each result as row to get the subject name
    echo '<td class="deckname-icon"><a href="addcard.php?subjectID='.$subject_id.'"><i class="fa fa-plus-circle"></i></a></td>';
    ?>
   </tr>
<!-- This is now displaying the rest of the already added cards -->

	<?php
  
      
	 $sql = "SELECT deckcontent.deckID, deckcontent.name, deckcontent.definition, deckcontent.subjectID, subject.subjectname, subject.subjectID FROM
	 deckcontent INNER JOIN subject ON
	 subject.subjectID=deckcontent.subjectID
	 WHERE subject.subjectID = $subject_id";
	 
	 $stm = $db->dbConn->prepare($sql);
	 
	$stm->execute(array());
	
	$result = $stm->fetchAll();
	 
	foreach ($result as $row) {
	  
	  $string = $row['name']; //holds the name of the card
      
	  ?>
	  
   <tr>
   <td> <?php echo subStringWords($string, 20); ?></td> <td class="deckname-icon"><a href="editcard.php?editID=<?php echo $row['deckID'].'&subjectID='.$subject_id; ?>"><i class="fa fa-pencil"></i></a></td>
</tr>
<?php      
	 } // end of each result as row
	 
      
?>
 
 
 
          </table>
  	</div> <!-- end of table -->
       
       <form action="flashcard.php" method="POST">
	    <input type="hidden" name="subjectID" value="<?php echo $subject_id ?>">
            <input type="submit" name="flashcard" value="Start Flashcard" class="button">
        </form>
        
        </div> <!-- end of bg -->
        </div> <!-- end of container -->
<?php



} else {
	require_once "index.php";
}

require_once "foot.php";
?>