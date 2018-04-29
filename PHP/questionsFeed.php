<?php

 session_start();

?>

<html>
   <head>
      <title>Questions</title>
      <link rel="stylesheet" type="text/css" href="questionFeed.css"/>
   </head>
   <body>
      <div class="searchBar">
         <p id="askTitle">ASK YOUR QUESTION</p>
            <form name="askBox" id="askBox" method="POST" action="AskQuestion.php">
               <input type="text" name="question" id="ask"/>
               <input type="submit" id="questionSubmit" name="questionSubmit" value="Ask"/>
            </form>
         
         <a href="" id="questionsFeed">Questions Feed</a>
         <a href="" id="notification">Notification</a>
         <a href="profile.php" id="userProfile"><?php echo $_SESSION['firstname'];?></a>
   
            <form name="logout" id="logout" method="POST" action="logout.php">
               <input type="submit" name="logout" value="Logout"/>
            </form>
       </div>
       
       <div class="questionContainer">
  
    <?php
	 
	 include 'db_connection.php';
	 
	 $result = mysqli_query($db,"Select Question, QuestionID from questions;");
	 
	 while($row = mysqli_fetch_assoc($result)){
		 
	?>
	
	<div class="question">
           <p><font size="5"><strong><?php echo $row['Question']?></strong></font></p>
	  
	    <?php
	 
	     $result2 = mysqli_query($db,"Select Answer, AnswerID, Thanks from answers where QuestionID=".$row['QuestionID'].";");
	 
	     while($row2 = mysqli_fetch_assoc($result2)){
		 
	    ?>
		
		<div class="answerContainer">
	           <p><font size="2"><?php echo $row2['Answer']?></font></p>
		</div>
	        
                <form class="thank" name="thank" method="POST" action="thank.php">
	          <input type="hidden" name="ansID" value="<?php echo $row2['AnswerID']?>"/>
		  <input type="submit" name="thank" value="Thank <?php echo $row2['Thanks'];?>"></input>
		</form>
		
	    <?php
		
	        }
		 
	    ?>
      
      <form name="answerBox" id="answerBox" method="POST" action="writeAnswer.php">
         <textarea name="answer" rows="2" cols="97" placeholder="Write answer" id="answer"></textarea></br>
         <input type="hidden" name="questionID" value="<?php echo $row['QuestionID'];?>"></input>	
         <input type="submit" name="answerSubmit" id="answerSubmit" value="submit"/>	 
      </form>
    
      </div>
	
         <?php	
		 
       	     }
   
         ?>
  
      </div>
   </body>
</html>
