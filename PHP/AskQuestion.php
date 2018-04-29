<?php

 session_start();
 
 if(isset($_POST['questionSubmit'])){
	
	include 'db_connection.php';
	
    $question = $_POST['question'];
	$question = strip_tags($question);
    $question = $db->real_escape_string($question);
	
	$askerID = $_SESSION['id'];
	
	$sql = "INSERT into questions(AskerID,Question) VALUES('$askerID','$question');";
	
	if(mysqli_query($db,$sql) == TRUE){
		header("Location: profile.php");
	}
 }

?>