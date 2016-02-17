[<?php
	
	$email = $_GET['email'];
	$password = $_GET['password'];
	
	include_once('../php/connectdb.php');
	$q = "SELECT accountID FROM accounts WHERE email='". $email . "' AND password='" . $password . "'";
	//echo $q;
	$run = mysqli_query($dbc, $q);
	$num = mysqli_num_rows($run);
	$data = mysqli_fetch_row($run);
	if($num == 1)
	{
		echo '{"accountID" : "' .  $data[0] . '"}';	
	}
	else
	{
		echo '{"accountID": "ERROR"}';	
	}
	
?>]