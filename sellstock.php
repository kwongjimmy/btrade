<?php
	require("config.php");
	require("connection.php");

	$username = $_POST['user'];
	$stock = $_POST['stockSymbol'];
	$shares = $_POST['shares'];
	$price = $_POST['price'];

	if($conn)
	{
		//GET USERS ACCOUNT 
		$sql = "SELECT banktransaction, personalstock, stocktransaction FROM users WHERE username = '$username'";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		$banktransaction = $row[0];
		$personalstock  = $row[1];
		$stocktransaction = $row[2];

		//GET # OF SHARES USER CURRENTLY HAVE FOR STOCK
		$sql = "SELECT shares FROM $personalstock WHERE name1 = '$stock'";
		$result = mysql_query($sql);
		$row = mysql_fetch_row($result);
		$personalshares  = $row[0];

		//CHECK TO SEE IF USER OWNS THIS STOCK
		if($shares > 0)
		{
			//CHECK TO SEE IF USER IS SELLING EXCEEDING AMOUNTS
			if($personalshares >= $shares)
			{
				$total = $personalshares - $shares; //# OF SHARES REMAINING AFTER SELLING
				$price = $price * $shares + 15; // calculate total price
				//UPDATE SHARES OF STOCK
				mysql_query("UPDATE $personalstock SET shares = '$total' WHERE name1 = '$stock'");
				//UPDATE BALANCE
				mysql_query("UPDATE users SET balance = balance + '$price' WHERE username = '$username'");

				//GET USER ACCOUNTS
				$sql = "SELECT banktransaction, personalstock, stocktransaction FROM users WHERE username = '$username'";
				$row = mysql_fetch_row(mysql_query($sql));
				$banktransaction = $row[0];
				$personalstock = $row[1];
				$stocktransaction = $row[2];

				//ADD BANK TRANSACTION
				$date = date("M d, Y"); //GET CURRENT DATE
				$time = date("h:i:s A"); //GET CURRENT TIME
				mysql_query("INSERT INTO $banktransaction VALUES ('B-TRADE-SELL', '$price', '$date', '$time')");
				//ADD STOCK TRANSACTION
				$negativeShares = -$shares;
				mysql_query("INSERT INTO $stocktransaction VALUES ('SOLD', '$stock', '$negativeShares', '$date', '$time')");

			}
			else
			{
				echo "Amount exceeds numbers of shares you currently have.";
			}
		}
		else
		{
			echo "ERROR: INVALID # OF SHARES";
		}
	}
?>