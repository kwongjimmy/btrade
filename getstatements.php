<?php
	require("config.php");
	require("connection.php");
	
	$username = $_POST['user'];	
	
	if ($conn) {
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
		
		$typeA = [];
		$amountA = [];
		$dateA = [];
		$timeA = [];
		
		$sql_13 = "SELECT * FROM " . $concat;
		$result_13 = mysql_query($sql_13);
		while ($row13 = mysql_fetch_array($result_13)) {
			$type = $row13["transfertype"];
			$amount = $row13["amount"];
			$date = $row13["date"];
			$time = $row13["time"];
			
			array_push($typeA, $type);
			array_push($amountA, $amount);
			array_push($dateA, $date);
			array_push($timeA, $time);
		}
		
		// JANK ALERT
		$length = count($typeA);
		for ($i = 0; $i < $length; $i++) {
			print $typeA[$i];
			
			if ($i + 1 < $length) {
				echo '*';
			}
		}
		
		echo '~';
		
		$length = count($amountA);
		for ($i = 0; $i < $length; $i++) {
			print $amountA[$i];
			
			if ($i + 1 < $length) {
				echo '*';
			}
		}
		
		echo '~';
		
		$length = count($dateA);
		for ($i = 0; $i < $length; $i++) {
			print $dateA[$i];
			
			if ($i + 1 < $length) {
				echo '*';
			}
		}
		
		echo '~';
		
		$length = count($timeA);
		for ($i = 0; $i < $length; $i++) {
			print $timeA[$i];
			
			if ($i + 1 < $length) {
				echo '*';
			}
		}
	}
	else {
		die();
	}
?>