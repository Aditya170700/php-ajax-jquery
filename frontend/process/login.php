<?php 
	include '../../config/db.php';

	if (!empty($_POST['login']) && $_POST['login'] = '1') {
		$email    = $_POST['email'];
		$password = $_POST['password'];

		$sqlCek   = "SELECT * FROM member WHERE member_email = '{$email}'";
		$getUser  = $conn->prepare($sqlCek);
		
		$getUser->execute();
				
		$dataUsr  = $getUser->fetchAll(PDO::FETCH_ASSOC);

		if (count($dataUsr) > 0) {
			if (password_verify($password, $dataUsr[0]['member_password'])) {
				session_start();
				if ($dataUsr[0]['member_status'] == 2) {
					$_SESSION['email']  = $dataUsr[0]['member_email'];
					$_SESSION['status'] = $dataUsr[0]['member_status'];
					echo 'member-login';
					return;
				} elseif ($dataUsr[0]['member_status'] == 0 || $dataUsr[0]['member_status'] == 1) {
					$_SESSION['email']  = $dataUsr[0]['member_email'];
					$_SESSION['status'] = $dataUsr[0]['member_status'];
					echo 'admin-login';
					return;
				}
			} else {
				echo "invalid-password";
			}
		} else {
			echo "invalid-email";
		}
	}