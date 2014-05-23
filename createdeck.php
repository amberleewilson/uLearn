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
 <?php
 
 // start of delete card
          
        if (isset($_POST['deletecard'])) {
         // get all the info from the form      
          $editcard_id = $_POST['cardid'];
          $cardname = $_POST['name'];
          $carddef = $_POST['definition'];
	  $subject_id = $_POST['subject_id']; //id of card
      
          require_once 'includes/MySQL.php';

	  require_once 'includes/db.php';
				
	  $db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
      
	 $sql = "DELETE FROM deckcontent WHERE deckID = $editcard_id"; 
            
          
  			$stm = $db->dbConn->prepare($sql);
                        
                      $stm->execute(array());
			
				// select from Database
	
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
	 
           
        } //end of delete card
	
 
  if (isset($_POST['add-card'])) { // add card
    
     require_once 'includes/MySQL.php';
    require_once 'includes/db.php';
    
    $name = $_POST['name']; //name of card
    $definition = $_POST['definition']; //definition of card
    $subject_id = $_POST['subject_id']; //id of card
    $user_id = 
    
    require_once 'includes/MySQL.php';

    require_once 'includes/db.php';

    $db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
		
    $sql = "INSERT INTO deckcontent (name, definition, subjectID) VALUES ('$name', '$definition', $subject_id)";
            
        $stm = $db->dbConn->prepare($sql);
	$stm->execute(array());

	// select from Database
	
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
  } //end of add card
?>
  </table>
	  
<?php

// start of edit card
          
        if (isset($_POST['editcard'])) {
         // get all the info from the form      
          $editcard_id = $_POST['cardid'];
          $cardname = $_POST['name'];
          $carddef = $_POST['definition'];
	  $subject_id = $_POST['subject_id']; //id of card
      
          require_once 'includes/MySQL.php';

	  require_once 'includes/db.php';
				
	  $db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
      
	$sql = "UPDATE deckcontent SET name='$cardname', definition='$carddef' WHERE deckID = $editcard_id";
            
          
  			$stm = $db->dbConn->prepare($sql);
                        
                        $stm->execute(array($_POST['name'], $_POST['definition']));
			
				// select from Database
	
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
	 
           
        } //end of edit card
?>
  </table>
	  
<?php
   if (isset($_POST['addsubject'])) {
  
      $subject_name = $_POST['subjectname'];
    
    require_once 'includes/MySQL.php';
    require_once 'includes/db.php';

    $db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
		
    $sql = "INSERT INTO subject (subjectname) VALUES ('$subject_name')";
            
    $stm = $db->dbConn->prepare($sql);
               
    $stm->execute(array());
    
    $new_subject_id = $db->dbConn->lastInsertId();
    
    //echo $subject_name;
   // echo $new_subject_id;

?>
<div class="table">

<table class="deckname">
<tr>
   
    <td><b><?php echo $subject_name; ?></b></td> <!-- subject name -->
</tr> 
</table>

<table class="deckdef">
  <tr class="grayed-out">
    <td>Add Card</td>
    <?php
    echo '<td class="deckname-icon"><a href="addcard.php?subjectID='.$new_subject_id.'"><i class="fa fa-plus-circle"></i></a></td>';
    ?>
  </tr>
</table>

<?php
 
  }  //end of add subject
  
?>
 
 

 
	</div> <!-- end of table -->
        </div> <!-- end of bg -->
        </div> <!-- end of container -->
<?php

} else {
	require_once "index.php";
}


require_once "foot.php";
?>