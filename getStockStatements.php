<?php
	require("config.php");
	require("connection.php");

	$username = $_POST['username'];
	if($conn)
	{
		//GET USER'S STOCK ACCOUNT
		$sql = "SELECT stocktransaction FROM users WHERE username = '$username'";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		$stocktransaction = $row[0];
		$sql = "SELECT * from $stocktransaction";
		$result = mysql_query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			$transfertype = $row["transfertype"];
			$stock = $row["stock"];
			$shares = $row["shares"];
			$date = $row["date"];
			$time = $row["time"];
			echo "$transfertype $stock $shares $date $time $arr," 
			//GHETTO ECHO OUT STRING OF TRANSACTION USE JAVASCRIPT TO SPLIT BY "," 
			//THEN SPLIT by " " for each array index
			//TO GET A GHETTO 2-D ARRAY
		}
	}
?>



