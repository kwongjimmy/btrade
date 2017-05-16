<?php
	require("config.php");
	require("connection.php");
	
	$n_username = $_POST['n_username'];
	$n_password = $_POST['n_password'];
	$firstname = $_POST['n_firstname'];
	$lastname = $_POST['n_lastname'];
	// Check connection
	if($conn)
	{
		$sql = "SELECT username FROM users WHERE username = '$n_username'";
		$result = mysql_query($sql);
		//User exist in database
		if(mysql_num_rows($result) > 0)
		{
			print "false";
		}
		else
		{
			//Insert firstname, lastname, username only. Account number will be auto-incremented.
			//$sql = "INSERT INTO users (firstname, lastname, username, password, balance) VALUES ('$firstname','$lastname','$n_username','$n_password',0)";
			mysql_query("INSERT INTO users (firstname, lastname, username, password, balance) VALUES ('$firstname','$lastname','$n_username','$n_password',0)");
			$sql = "SELECT accountnumber FROM users WHERE username = '$n_username'";
			$result = mysql_query($sql);
			$row = mysql_fetch_row($result);
			//Get account number to create banktransaction,personalstock, and stocktransation tables.
			$accountnumber = $row[0];
			$name = $lastname;
			$Banktransaction = "'$name'_$accountnumber";
			$Banktransaction = str_replace("'","",$Banktransaction);
			$PersonalStock = "'$name'_'$accountnumber'_stock";
			$PersonalStock = str_replace("'","",$PersonalStock);
			$Stocktransaction = "'$name'_'$accountnumber'_stocktransaction";
			$Stocktransaction = str_replace("'","",$Stocktransaction);
			//Create Tables
			mysql_query("CREATE TABLE $Banktransaction(transfertype varchar(40), amount decimal(65,2) , date nvarchar(100), time nvarchar(100))");
			//mysql_query("CREATE TABLE $PersonalStock(stock varchar(40), shares int)");
			mysql_query("CREATE TABLE $PersonalStock(shares int) AS (SELECT name1,name2,0 AS shares FROM stocks)");
			mysql_query("CREATE TABLE $Stocktransaction(transfertype varchar(40), stock varchar(40), shares int, date nvarchar(100), time nvarchar(100))");
			mysql_query("UPDATE users SET banktransaction='$Banktransaction', personalstock='$PersonalStock', stocktransaction='$Stocktransaction' WHERE username = '$n_username'");
			print "true";
		}
	}
	else
	{
	    die("Connection failed: " . $conn->connect_error);
	}
?>