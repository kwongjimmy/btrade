<?php
// Required Files
require('config.php');
require("connection.php");
// Create connection
//$conn = mysql_connect($hostname, $username, $password);
//mysql_select_db("project2");
$arr = [];
// Check connection
if($conn)
{
	$sql = 'SELECT * FROM stocks ORDER BY name1';
	$result = mysql_query($sql);
	while ($row = mysql_fetch_assoc($result)) {
    	$stockSymbols = $row["name1"];
    	$stockName = $row["name2"];
    	$leStocks = $stockSymbols.", ".$stockName;
    	array_push($arr, $leStocks);
	}
	echo json_encode($arr);
}
else{
    die("Connection failed: " . $conn->connect_error);
}
?> 