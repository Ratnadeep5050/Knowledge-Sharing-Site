<?php

session_start();

 if(isset($_POST['answerSubmit'])){
	
	include 'db_connection.php';
	
        $answer = $_POST['answer'];
	$answer = strip_tags($answer);
        $answer = $db->real_escape_string($answer);
	
	$questionID = $_POST['questionID'];
	
	$authorID = $_SESSION['id'];
	
	$sql = "INSERT into answers(QuestionID, AuthorID, Answer) VALUES('$questionID','$authorID','$answer');";
	
	if(mysqli_query($db,$sql) == TRUE){
	   header("Location: profile.php");
	}
 }


?>
