<?php 

	session_start();

	if (empty($_SESSION['status']) && empty($_SESSION['email'])) {
		$email = '';
	} elseif ($_SESSION['status'] == 2 && !empty($_SESSION['email'])) {
		$email = $_SESSION['email'];
	} else {
		header('Location: ../../backend/index.php');
	}

	if (!empty($_GET['param']) && $_GET['param'] == 'logout') {
		session_destroy();
		header('Location: ../index.php');
	}