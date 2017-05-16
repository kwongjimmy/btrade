<?php
	require("config.php");
	require("connection.php");
	$username = $_POST['username'];
	$password = $_POST['password'];
	session_start();
	// Check connection
	if($conn)
	{
		$sql = "SELECT username,password FROM users WHERE username = '$username' and password = '$password'";
		$result = mysql_query($sql);
		if(mysql_num_rows($result) === 1)
		{
			$_SESSION['user'] = $username; 
			print "true";
		}
		else
		{
			print "Incorrect Username or Password.";
		}
	}
?>