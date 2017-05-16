<?php
	$n_username = $_POST['n_username'];
	$n_password = $_POST['n_password'];
	
	if ($n_username != "Ken") {
		print "true";
	}
	else {
		print "false";
	}
?>