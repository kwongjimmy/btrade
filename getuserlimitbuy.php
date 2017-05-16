<?php
	require("config.php");
	require("connection.php");

	$username = $_POST['user'];

	// Check connection
	if($conn)
	{
		$sql = "SELECT * FROM limitbuy WHERE username = '$username'";
		$result = mysql_query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			$stock = $row["stock"];
			$shares = $row["shares"];
			$price = $row["price"];
			echo "$stock $shares $price," 
			//GHETTO ECHO OUT STRING OF TRANSACTION USE JAVASCRIPT TO SPLIT BY "," 
			//THEN SPLIT by " " for each array index
			//TO GET A GHETTO 2-D ARRAY 
		}
	}
?>	