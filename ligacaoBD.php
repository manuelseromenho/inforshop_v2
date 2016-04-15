<?php

	/*$servername = "inforzen.com";
	$username = "inforshop";
	$password = "123BangBang+";
	$dbname = "inforshop";
	$port = "7575";*/

	$servername = "127.0.0.1";
	$username = "root";
	$password = "123bang";
	$dbname = "inforshop";
	$port = "3306";

	$mysqli = new mysqli($servername, $username, $password, $dbname, $port);
	mysqli_set_charset($mysqli, "utf8");

	if(!$mysqli)
	{
		echo $mysqli->error;
	}

	if ($mysqli->connect_errno) 
	{
	    echo "Failed to connect to MySQL: (".$mysqli->connect_errno.") " . $mysqli->connect_error;
	}


?>
