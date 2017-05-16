<?php
	$user = $_POST['user'];
	$symbol = $_POST['stockSymbol'];
	$shares = $_POST['shares'];
	$price = $_POST['price'];
	$totalPrice = $_POST['totalPrice'];
	echo "$user $symbol $shares $price $totalPrice";
?>