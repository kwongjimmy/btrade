<?php
	$conn = mysql_connect($hostname, $username, $password);
	mysql_select_db("project2");
	$username = $_POST['n_username'];
	$password = $_POST['n_password'];

	// Check connection
	if($conn)
	{
		session_start();
		$sql = "SELECT username,password FROM users WHERE username = '$username' and password = '$password'";
		$row = mysql_fetch_array($sql);
		if(!empty($row['username']) AND !empty($row['password']))
		{
			$_SESSION['userName'] = $row['username'];
			echo "logged in";
		}
		else
		{
			echo "incorrect";
		}
	}
	else{
		print "false";
	    die("Connection failed: " . $conn->connect_error);
	}
?>