<?php

if(isset($_POST['thank'])){
	
	include 'db_connection.php';
	
	$ansID = $_POST['ansID'];
	
	$result = mysqli_query($db,"UPDATE answers SET Thanks=Thanks+'1' WHERE AnswerID='$ansID';");
	
	header('Location: profile.php');
}

?>