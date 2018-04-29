<?php

session_start();

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
	 
	 $email = $_POST['email'];
	 $password = $_POST['password'];
	 
	 include 'db_connection.php';
	 
	 $email = strip_tags($email);
	 $email = $db->real_escape_string($email);
	 
	 $password = strip_tags($password);
	 $password = $db->real_escape_string($password);
	 $password = sha1($password);
	 
	 $sql = "select ID, Firstname, Email, Password from users where Email='$email' and Password='$password';";
	 	 
	 if($result = mysqli_query($db,$sql)){
		while($row = mysqli_fetch_assoc($result)){
		      $_SESSION['firstname'] = $row['Firstname'];
			  $_SESSION['id'] = $row['ID'];
	    }
		 header("Location: profile.php");
	 }
	 else{
		 header("Location: index.php");
	 }
	 
 }

?> 
