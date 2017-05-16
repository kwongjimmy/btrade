<?php
	require("config.php");
	require("connection.php");
	
	$username = $_GET['name'];
	$deposit = $_POST['funds7'];
	$userBalance = [];
	
	if ($conn) {
		$sql = "SELECT balance FROM users WHERE username = '$username'";
		$result = mysql_query($sql);
		while ($row = mysql_fetch_array($result)) {
			$balance = $row["balance"];
			array_push($userBalance, $balance);
		}
		
		if ($deposit <= 100) {
			$newBalance = $userBalance[0] + $deposit;
			$sql_1 = "UPDATE users SET balance='" . $newBalance . "' WHERE username='" . $username . "'";				
			$result_1 = mysql_query($sql_1);
			
			// TRANSACTION SNIPPET
			$lastName = [];
			$accountNumber = [];
			
			$sql_10 = "SELECT lastname FROM users WHERE username = '$username'";
			$result_10 = mysql_query($sql_10);
			while ($row10 = mysql_fetch_array($result_10)) {
				$lastname = $row10["lastname"];
				array_push($lastName, $lastname);
			}
			$sql_11 = "SELECT accountnumber FROM users WHERE username = '$username'";
			$result_11 = mysql_query($sql_11);
			while ($row11 = mysql_fetch_array($result_11)) {
				$accountnumber = $row11["accountnumber"];
				array_push($accountNumber, $accountnumber);
			}
			$concat = $lastName[0] . "_" . $accountNumber[0];
			
			// recorded
			$dateFormat = date("M d, Y");
			$timeFormat = date("h:i:s A");
			$sql_12 = "INSERT INTO $concat VALUES ('DEPOSIT', '$deposit', '$dateFormat', '$timeFormat')";
			$result_12 = mysql_query($sql_12);
			// END OF TRANSACTION SNIPPET
			
			echo "$" . $deposit . " successfully deposited."; 
		}
		else {
			echo "You must purchase the Titanium Premier Pass&trade; to deposit over $100.";
		}
	}	
	else {
		echo "Connection to database failed.";
	}
?>