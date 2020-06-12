<?php 

	session_start();

	if (!empty($_SESSION['email'])) {
		if ($_SESSION['status'] == 0 || $_SESSION['status'] == 1 || $_SESSION['status'] == '0' || $_SESSION['status'] == '1') {
			$email = $_SESSION['email'];
		} else {
			header('Location: ../frontend/views/index.php');
		}
	} else {
		header('Location: ../frontend/views/index.php');
	}