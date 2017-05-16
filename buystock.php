<?php
	require("config.php");
	require("connection.php");

	$username = $_POST['user'];
	$stock = $_POST['stockSymbol'];
	$shares = $_POST['shares'];
	$price = $_POST['price']; //PRICE PER SHARE
	if($conn)
	{
		$price = $price * $shares + 15; 
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

			//GET USER ACCOUNTS
			$sql = "SELECT banktransaction, personalstock, stocktransaction FROM users WHERE username = '$username'";
			$row = mysql_fetch_row(mysql_query($sql));
			$banktransaction = $row[0];
			$personalstock = $row[1];
			$stocktransaction = $row[2];

			//SET # OF SHARES USER OWN FOR THE STOCK USER IS BUYING
			mysql_query("UPDATE $personalstock SET shares = shares + '$shares' WHERE name1 = '$stock'");
			$date = date("M d, Y"); //GET CURRENT DATE
			$time = date("h:i:s A"); //GET CURRENT TIME

			//ADD CURRENT TRANSACTION TO STOCK TRANSACTION TABLE
			mysql_query("INSERT INTO $stocktransaction VALUES ('BOUGHT', '$stock', '$shares', '$date', '$time')");
			//ADD CURRENT TRANSACTION TO BANK TRANSACTION TABLE
			$price = "-$price";
			mysql_query("INSERT INTO $banktransaction VALUES ('B-TRADE-BUY', '$price', '$date', '$time')");
		}
		else
		{
			echo "Insufficient funds";
		}
	}