<?php
	require("config.php");
	require("connection.php");
	if($conn){	
		$counter = 0; 
		while($counter != 5){
			$sql = "UPDATE users SET balance = balance + 123123123 WHERE username = 'jimmykwong'";
			mysql_query($sql);
			$counter = $counter +1;
			echo "hello?  $counter <br>";
			sleep(5);
		}
	}
?>