<?php
	// Aditya ricki julianto
	// 3183111056
	// D3SI-B
	$host	= "127.0.0.1";
	$user   = "root";
	$pass	= "";
	$db		= "pwebdb_tugasbesar";
	date_default_timezone_set('Asia/Jakarta');

	// $conn   = mysqli_connect($host, $user, $pass, $db);
	$conn = new PDO('mysql:host=localhost;dbname=pwebdb_tugasbesar', 'root', '');

	if(!$conn)
	{
		echo 'Database tidak dikenal';
		die();
	}