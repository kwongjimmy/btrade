<?php
	session_start();
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if ($username == "Ken") {
		$_SESSION['user'] = $username; 
		print "true";
	}
	else {
		print "Invalid Credentials";
	}
?>