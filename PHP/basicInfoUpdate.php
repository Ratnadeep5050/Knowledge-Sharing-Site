<?php

 session_start();

 if(isset($_POST['updateBasicInfo'])){
	
	$location = $_POST['location'];
	$occupation = $_POST['occupation'];
	$education = $_POST['education'];
	
	include "db_connection.php";
	 
	$location = strip_tags($location);
    $location = $db->real_escape_string($location);
	
	$occupation = strip_tags($occupation);
    $occupation = $db->real_escape_string($occupation);
	
	$education = strip_tags($education);
    $education = $db->real_escape_string($education);
	
	$id = $_SESSION['id'];
	
	if(mysqli_query($db,"UPDATE basic_info SET Location='$location', Occupation='$occupation', Education='$education' WHERE ID='$id';") == TRUE){
		header("Location: profile.php");
	}
 }
 else if(isset($_POST['updateImpressum'])){
	 
	$impressum = $_POST['impressum'];
	
	include "db_connection.php";
	 
	$impressum = strip_tags($impressum);
    $impressum = $db->real_escape_string($impressum);
	
	$id = $_SESSION['id'];
	
	if(mysqli_query($db,"UPDATE basic_info SET Impressum='$impressum' WHERE ID='$id';") == TRUE){
		header("Location: profile.php");
	}
 }

?>