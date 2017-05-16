<?php
	require("config.php");
	require("connection.php");

	$username = $_POST['user'];
	if($conn)
	{
		//GET USER'S STOCK ACCOUNT
		$sql = "SELECT personalstock FROM users WHERE username = '$username'";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		$personalstock = $row[0];

		$sql = "SELECT name1, shares from $personalstock WHERE shares > 0";
		$result = mysql_query($sql);
		while($row = mysql_fetch_assoc($result)) {
			$name1 = $row["name1"];
			$shares = $row["shares"];
			echo "$name1 $shares,"; //PRINTS OUT STOCK SHARES FOR JAVASCRIPT SPLIT()
		}
	}
?>
