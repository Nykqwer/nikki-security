<?php
	$conn = new mysqli('localhost:3308', 'root', '', 'voting');
	
	if(!$conn){
		die("Error: Failed to connect to database");
	}
?>	