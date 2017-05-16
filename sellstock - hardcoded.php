<?php
	require("config.php");
	require("connection.php");

	//$username = $_POST['user'];
	//$stock = $_POST['stockSymbol'];
	//$shares = $_POST['shares'];
	//$price = $_POST['totalPrice'];
	$username = 'jimmykwong';
	$stock = 'aapl';
	$shares = '1';
	$price = '1000';

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
		if($shares >= 0)
		{
			//CHECK TO SEE IF USER IS SELLING EXCEEDING AMOUNTS
			if($personalshares >= $shares)
			{
				$total = $personalshares - $shares; //# OF SHARES REMAINING AFTER SELLING
				//UPDATE SHARES OF STOCK
				mysql_query("UPDATE $personalstock SET shares = '$total' WHERE name1 = '$stock'");
				//UPDATE BALANCE
				mysql_query("UPDATE users SET balance = balance + '$price' WHERE username = '$username'");

				//ADD BANK TRANSACTION
				$date = date("M d, Y"); //GET CURRENT DATE
				$time = date("h:i:s A"); //GET CURRENT TIME
				mysql_query("INSERT INTO $banktransaction VALUES ('B*TRADE', '$price, '$date', '$time')");

				//ADD STOCK TRANSACTION
				mysql_query("INSERT INTO $stocktransaction VALUES ('SOLD', '$stock', '$shares', '$date', '$time')");
				echo "done";
			}
			else
			{
				echo "Amount exceeds numbers of shares you currently have.";
			}
		}
		else
		{
			echo "You do not own any shares of this stock.";
		}
	}