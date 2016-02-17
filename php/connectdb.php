<?php
	/*
	* @Author Sean O'Brien
	* @Version 0.0.5
	* @Copyright : © Copyright 2008 openlanguages.net
	* @Desicription: this allow the site to connect to the mySQLI database
	*/

	define ('DB_USER', 'jacques');
	define ('DB_PASSWORD', 'netandre60!cP');
	define ('DB_HOST','localhost');
	define ('DB_NAME','jacques_sandbox');
	
	//Run the connection to the Database
	$dbc = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die('Could not connect to MySQL: ' . mysqli_connect_error());
?>