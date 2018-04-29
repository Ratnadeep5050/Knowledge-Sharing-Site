<?php

 if($_SERVER['REQUEST_METHOD'] == 'POST'){
	 
	$firstname = $_POST['firstname'];
	$surname = $_POST['surname'];
        $email = $_POST['email'];	
	$password = $_POST['password']; 
	$sex = $_POST['sex'];
	
	include 'db_connection.php';
	
	$firstname = strip_tags($firstname);
        $firstname = $db->real_escape_string($firstname);
	
	$surname = strip_tags($surname);
        $surname = $db->real_escape_string($surname);
	
	$email = strip_tags($email);
        $email = $db->real_escape_string($email);
	
	$password = strip_tags($password);
        $password = $db->real_escape_string($password);
	$password = sha1($password);
	
	$sex = strip_tags($sex);
        $sex = $db->real_escape_string($sex);
	
	if(empty($firstname) || empty($surname) || empty($email) || empty($password) || empty($sex)){
		
		echo '<script type="text/javascript">';
		echo 'alert("Information Missing")';
		echo '</script>';
		die();
	}
	
	$sql = "INSERT INTO users(Firstname, Surname, Email, Password, Sex) VALUES('$firstname','$surname','$email','$password','$sex');";
	
	if(mysqli_query($db,$sql) == TRUE){
		echo '<script type="text/javascript">';
		echo 'alert("Submission Done");';
		echo '</script>';
		
		header('Location: index.html');
	}
	else{
		echo '<script type="text/javascript">';
		echo 'alert("Submission Failed");';
		echo '</script>';
		
		header('Location: index.html');
	}
	
	$sql = "SELECT ID from users where Firstname='$firstname';";
	
	if($result = mysqli_query($db,$sql)){
		
		while($row = mysqli_fetch_assoc($result)){
			$ID = $row['ID'];
		}
		mysqli_query($db,"INSERT into basic_info(ID) VALUES('$ID');");
	}
	
	mysqli_close($db);
	 
 }

?>
