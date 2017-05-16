<?php
	require("config.php");
	require("connection.php");
	
	$username = $_GET['name'];
	$target = $_POST['targetAcc'];
	$funds = $_POST['funds'];
	$accountNumbers = [];
	$userBalance = [];
	$targetBalance = [];
	
	if ($conn) {
		// Gets all users in the database in an array
		$sql = "SELECT accountnumber FROM users";
		$result = mysql_query($sql);
		while ($row = mysql_fetch_array($result)) {
			$accountnumber = $row["accountnumber"];
			array_push($accountNumbers, $accountnumber);
		}
		
		// Checks if the the target account exists
		
		if (in_array($target, $accountNumbers, true)) {
			// Gets the balance of the current user
			$sql_1 = "SELECT balance FROM users WHERE username = '$username'";
			$result_1 = mysql_query($sql_1);
			while ($row1 = mysql_fetch_array($result_1)) {
				$balance = $row1["balance"];
				array_push($userBalance, $balance);
			}
			
			if ($funds > 1000) {
				echo "You must purchase the Titanium Premier Pass&trade; to transfer over $1000.";
				die();
			}
			else if ($userBalance[0] >= $funds) { // Checks if the current user has enough funds to transfer
				$newBalance = $userBalance[0] - $funds;
				
				// Updates current user's balance
				$sql_2 = "UPDATE users SET balance='" . $newBalance . "' WHERE username='" . $username . "'";				
				$result_2 = mysql_query($sql_2);
				
				// Gets targeted account's balance
				$sql_3 = "SELECT balance FROM users WHERE accountnumber = '$target'";
				$result_3 = mysql_query($sql_3);
				while ($row2 = mysql_fetch_array($result_3)) {
					$balance = $row2["balance"];
					array_push($targetBalance, $balance);
				}
				
				$newTargetBalance = $targetBalance[0] + $funds;
				
				// Updates targeted account's balance
				$sql_4 = "UPDATE users SET balance='" . $newTargetBalance . "' WHERE accountnumber='" . $target . "'";				
				$result_4 = mysql_query($sql_4);
				
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
				
				// second
				$lastName_1 = [];
				$accountNumber_1 = [];
				
				$sql_10_1 = "SELECT lastname FROM users WHERE accountnumber = '$target'";
				$result_10_1 = mysql_query($sql_10_1);
				while ($row10_1 = mysql_fetch_array($result_10_1)) {
					$lastname_1 = $row10_1["lastname"];
					array_push($lastName_1, $lastname_1);
				}
				$concat_1 = $lastName_1[0] . "_" . $target;

				// recorded
				$dateFormat = date("M d, Y");
				$timeFormat = date("h:i:s A");
				$sql_12 = "INSERT INTO $concat VALUES ('TRANSFER', '$funds', '$dateFormat', '$timeFormat')";
				$result_12 = mysql_query($sql_12);
				$sql_13 = "INSERT INTO $concat_1 VALUES ('RECEIVE', '$funds', '$dateFormat', '$timeFormat')";
				$result_13 = mysql_query($sql_13);
				// END OF TRANSACTION SNIPPET
				
				echo "$" . $funds . " successfully transferred to account " . $target . ".";
			}
			else
			{
				echo "Your account has insufficient funds.";
			}
		}
		else {
			echo "Targeted account does not exist.";
		}
	}	
	else {
		echo "Connection to database failed.";
	}
?>