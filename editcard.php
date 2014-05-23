<?php
  session_start();
  require_once "header.php";
     
if (isset($_SESSION['logged_in_user'])) {   

  ?>

 
<div class="bg">
	<div class="container">
 <header>
    

        
    
          
    <p>EDIT CARD</p>

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
    
    if (isset($_GET["editID"])){
        
	$editID=$_GET["editID"];
        
          require_once 'includes/MySQL.php';

	require_once 'includes/db.php';

	$db = new MySQL($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['database']);
        
        $sql = "SELECT deckID, name, definition FROM deckcontent WHERE deckID = $editID";
        
                
        $stm = $db->dbConn->prepare($sql);
	
	$stm->execute(array());
	
	$result = $stm->fetchAll();
        
        foreach ($result as $row) {
            
            $deckid = $row['deckID'];
            $deckname = $row['name'];
            $deckdefinition = $row['definition'];
            
        }
        
    }

 ?>
 

 
 <form action="createdeck.php" method="post" class="addcard-form">
    
<input type="hidden" name="cardid" value="<?php echo $deckid; ?>" />
		<label for="name"></label>
		<textarea name="name" cols="31" rows="20" id="name" value="name" class="addcard"><?php echo $deckname; ?></textarea><br>
			
		<label for="definition"></label>
		<textarea name="definition" cols="31" rows="20" id="definition" value="definition" class="addcard"><?php echo $deckdefinition; ?></textarea><br>
                
                
<input type="hidden" name="subject_id" value="<?php echo $_GET['subjectID']; ?>">
		
		<input type="submit" name="deletecard" value="Delete" class="button-3">
		<input type="submit" name="editcard" value="Done" class="button-4">
	</form>
    </div>
 
 
 
 
 
 
 
 
 
 
 
    </div> <!-- end of bg -->
    </div> <!-- end of container -->
<?php

} else {
  require_once "index.php";
}
require_once "foot.php";
?>