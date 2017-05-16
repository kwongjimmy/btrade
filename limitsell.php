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
		//GET USERS ACCOUNT 
		$sql = "SELECT personalstock FROM users WHERE username = '$username'";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		$personalstock  = $row[0];

		//GET # OF SHARES USER CURRENTLY HAVE FOR STOCK
		$sql = "SELECT shares FROM $personalstock WHERE name1 = '$stock'";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		$personalshares  = $row[0];

		//CHECK TO SEE IF USER HAVE ENOUGH SHARES TO SELL
		if($personalshares >= $shares)
		{
			$total = $personalshares - $shares; //SHARES AFTER DEDUCTION
			$sql = "UPDATE $personalstock SET shares = '$total' WHERE name1 = '$stock'";
			mysql_query($sql);

			$sql = "INSERT INTO limitsell VALUES ('$stock','$shares', '$price', '$username')";
			mysql_query($sql);
		}
		else
		{
			echo "Amount exceeds numbers of shares you currently have.";
		}

	}
?>