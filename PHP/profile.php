<?php 

 session_start();
 
 $id = $_SESSION['id'];
 $name = $_SESSION['firstname'];
 
 include "db_connection.php";
 
 $result = mysqli_query($db,"SELECT Location, Occupation, Education, Impressum FROM basic_info WHERE ID='$id';");
 
 $row = mysqli_fetch_assoc($result);

?>

<html>

 <head>
 
  <title>
  
   <?php
   
	echo $_SESSION['firstname'];
   
   ?>
  
  </title>
  <link rel="stylesheet" type="text/css" href="profile2.css"/>
 
 </head>
 
 <body>
 
  <div class="searchBar">
  
   <p id="askTitle">ASK YOUR QUESTION</p>
   
   <form name="askBox" id="askBox" method="POST" action="AskQuestion.php">
   
    <input type="text" name="question" id="ask"/>
	
	<input type="submit" id="questionSubmit" name="questionSubmit" value="Ask"/>
   
   </form>
   
   <a href="questionsFeed.php" id="questionsFeed">Questions Feed</a>
   <a href="" id="notification">Notification</a>
   <a href="profile.php" id="userProfile"><?php echo $_SESSION['firstname'];?></a>
   
   <form name="logout" id="logout" method="POST" action="logout.php">
   
    <input type="submit" name="logout" value="Logout"/>
   
   </form>
   
  </div>
  
  
  
  <div class="Intro">
  
   <img id="profilePic" src="d.jpg"/>
   
   <div id="username">
    <p><?php echo $_SESSION['firstname']?></p>
   </div>
   
  </div>
  
  
  
  <div class="impressum">
  
   <form name="impressum" method="POST" action="basicInfoUpdate.php">
  
    <textarea rows="3" cols="70" id="impressum" name="impressum" style="background: rgba(240, 248, 255, 0.31); border: 0px; font-size: 19px;"><?php echo $row['Impressum'];?></textarea>
   
    <input type="submit" name="updateImpressum" value="Update"/>
	
   </form>	
  
  </div>
  
  
  
  <div class="basicInfo">
  
   <form name="basicinfo" method="POST" action="basicInfoUpdate.php">
   
    <h3>Location</h3>
	<input type="text" name="location" value="<?php echo $row['Location'];?>" style="background: transparent; border: 0px;"/></br>
	
	<h3>Occupation</h3>
	<input type="text" name="occupation" value="<?php echo $row['Occupation'];?>" style="background: transparent; border: 0px;"/></br>
	
	<h3>Education</h3>
	<input type="text" name="education" value="<?php echo $row['Education'];?>" style="background: transparent; border: 0px;"/></br>
	
	<input type="submit" name="updateBasicInfo" value="Update" style="margin-top: 20px;"/>
	
   </form>
  
  </div>
  
  
  
  <div class="chat">
  
   <a href="chatRoom.php"><strong>Chat Room</strong></a></br>
  
   <?php
   
    $result = mysqli_query($db,"SELECT Firstname FROM users WHERE Firstname NOT IN ('$name');");
	
	while($row = mysqli_fetch_assoc($result)){
		
   ?>

    <a href=""><font size="4"><strong><?php echo $row['Firstname']."</br>";?></strong></font></a>
	
   <?php
	
	}
   
   ?>
  
  </div>
  
  
  
  <div class="content">
  
   <?php
   
    $authorID = $_SESSION['id']; 
	
	$result = mysqli_query($db,"SELECT DISTINCT QuestionID FROM answers WHERE AuthorID='$authorID';");
	
	while($row = mysqli_fetch_assoc($result)){
		
   ?>
   
    <div class="question">
   
     <p>
	  <font size="5">
	   <strong>
	    <?php
         $result1 = mysqli_query($db,"SELECT Question FROM questions WHERE QuestionID=".$row['QuestionID'].";");		
		 $row2 = mysqli_fetch_assoc($result1);
		 echo $row2['Question'];
	    ?>
	   </strong>
	  </font>
	 </p>
	 
	  <?php
	 
	     $result2 = mysqli_query($db,"Select Answer, AnswerID, Thanks from answers where QuestionID=".$row['QuestionID'].";");
	 
	     while($row3 = mysqli_fetch_assoc($result2)){
		 
	  ?>
		
		<div class="answerContainer">
		
		 <p><font size="2"><?php echo $row3['Answer']?></font></p></br>
		 
		</div>
		
		<form class="thank" name="thank" method="POST" action="thank.php">
		
		 <input type="hidden" name="ansID" value="<?php echo $row3['AnswerID']?>"/>
		 
		 <input type="submit" name="thank" value="Thank <?php echo $row3['Thanks'];?>"></input>
		 
		</form>
		
	  <?php
		
		}
		
	  ?>
	  
	  </div>

      <?php	  
		
	}
		 
      ?>
	  
	  
  
  </div>
 
 </body>

</html>