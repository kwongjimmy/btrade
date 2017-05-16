<?php
	require("config.php");
	require("connection.php");

	$username = $_POST['user'];
	$stock = $_POST['stockSymbol'];
	$shares = $_POST['shares'];
	$price = $_POST['price'];

	// Check connection
	if($conn)
	{
		//GET CURRENT BALANCE OF USER
		$sql = "SELECT balance FROM users WHERE username = '$username'";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		$balance  = $row[0];

		//CHECK IF STOCK PRICE EXCEEDS BALANCE
		if($balance >= $price)
		{
			$total = $balance - $price; //CALCULATE NEW BALANCE
			//UPDATE BALANCE
			$sql = "UPDATE users SET balance = '$total' WHERE username = '$username'";
			mysql_query($sql);

			$sql = "INSERT INTO limitbuy VALUES ('$stock','$shares', '$price', '$username')";
			mysql_query($sql);
		}
		else
		{
			echo "Insufficient funds";
		}
	}
?>