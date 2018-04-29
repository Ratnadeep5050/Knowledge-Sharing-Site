<?php

 session_start();

 if(isset($_POST['send'])){
	 
	include 'db_connection.php';
	
	$message = $_POST['message'];
        $message = strip_tags($message);
        $message = $db->real_escape_string($message);
	
	$name = $_SESSION['firstname'];

        $sql = "INSERT INTO chat(Name, Message) VALUES('$name','$message');";

        if(mysqli_query($db,$sql) == TRUE){
		header("Location: chatRoom.php");
	}	
	 
 }

?>
