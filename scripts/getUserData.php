[<?php
	include_once('../php/connectdb.php');
	$q = "SELECT * FROM accounts WHERE accountID='" . $_GET["accountID"] . "'";
	
	$run = mysqli_query($dbc,$q);
	$data = mysqli_fetch_array($run);
	
	
	$text[1] = 'name';
	
	echo "{" . '"email" : "' . $data['email'] . '", "name" : "' . $data['firstName'] ." ". $data['lastName'] . '"}' 
?>]