<?php
	require("config.php");
	require("connection.php");
	
	$username = $_POST['user'];	
	$arr = [];
	
	if ($conn) {
		$sql = "SELECT firstname,lastname,username,balance,accountnumber FROM users WHERE username = '$username'";
		$result = mysql_query($sql);	
		
		while ($row = mysql_fetch_array($result)) {
			$firstname = $row["firstname"];
			$lastname = $row["lastname"];
			$username = $row["username"];
			$balance = $row["balance"];
			$accountnumber = $row["accountnumber"];
			array_push($arr, $firstname);
			array_push($arr, $lastname);
			array_push($arr, $username);
			array_push($arr, $balance);
			array_push($arr, $accountnumber);
		}
		//echo json_encode($arr);
		
		$length = count($arr);
		for ($i = 0; $i < $length; $i++) {
			print $arr[$i];
			
			if ($i + 1 < $length) {
				echo '*';
			}
		}
	}
	else
	{
		die();
	}
?>