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
  <title>Chat Room</title>
  <link rel="stylesheet" type="text/css" href="chatRoom1.css"/> 
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
  
  <div class="chatScreen">
   <div class="messageDisplay">
    <?php
	
	 $result = mysqli_query($db,"SELECT * FROM chat;");
	 
	 while($row = mysqli_fetch_assoc($result)){
		 echo $row['Name'].":: ";
		 echo $row['Message']."</br>";
	 }
	
	?>
   </div>
   <form id="message" method="POST" action="chat.php">
    <textarea name="message" rows="3" cols="72"></textarea></br>
	<input type="submit" name="send" id="send"value="send"/>
   </form>
  </div>
 
 </body>
</html>