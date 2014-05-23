<?php
  session_start();
  require_once "header.php";

     
if (isset($_SESSION['logged_in_user'])) {   

  ?>
 
<div class="bg">
	<div class="container">
 <header>
    

        
     <a href="javascript:history.go(-1)"><span class="left"><img src="images/arrow.png" alt="go back" width="31" height="22"></span></a>
          
    <p>FLASHCARDS</p>

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
  
  if (isset($_POST['flashcard'])) { }
 
 $subject_id = $_POST['subjectID'];
 
  require_once 'includes/MySQL.php';
  require_once 'includes/db.php';

    $db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
    
     $sql = "SELECT deckcontent.deckID, deckcontent.name, deckcontent.definition, deckcontent.subjectID, subject.subjectname, subject.subjectID FROM
	 deckcontent INNER JOIN subject ON
	 subject.subjectID=deckcontent.subjectID
	 WHERE subject.subjectID = $subject_id";
	 
	  $stm = $db->dbConn->prepare($sql);
	 
	$stm->execute(array());
	
	$result = $stm->fetchAll();
	
	$idnumber = 0;
	 
	foreach ($result as $row) {
	  
	//  echo $row['name'];
	//  echo $row['definition'];
	
 ?>

	<div class="flip-container" id="flip-toggle<?php echo $idnumber; ?>" class="flip-card">
		<div class="flipper">
			<div class="front">
				<span class="name"><?php echo $row['name']; ?></span>
			</div>
			<div class="back" style="background:#f8f8f8;">
				
				<p><?php echo $row['definition']; ?></p>
			</div>
		</div>
	</div>
	
	<?php

$idnumber++;

	} // end of foreach result as row
	
	?>
		
	<div class="flashcard-buttons-previous">
  <a href="#"><p class="previous">Previous</p></a>
 </div>
	
	<div class="flashcard-buttons-next">
	<a href="#"><p class="next">Next</p></a>
  </div>
 
 
        </div> <!-- end of bg -->
        </div> <!-- end of container -->
<?php

} else {
	require_once "index.php";
}

require_once "foot.php";
?>