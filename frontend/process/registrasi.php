<?php 
	include '../../config/db.php';

	if (!empty($_POST['registrasi']) && $_POST['registrasi'] == '1') {
		$name     = $_POST['name'];
		$email    = $_POST['email'];
		$phone    = $_POST['phone'];
		$password = $_POST['password'];
		$identity = $_POST['identity'];
		$gender   = $_POST['gender'];
		$address  = $_POST['address'];
		$saldo	  = 0;
		$status	  = '2';

		$cekEmail = "SELECT * FROM member WHERE member_email = '{$email}'";

		$cek 	  = $conn->prepare($cekEmail);

		$cek->execute();

		$dataUsr  = $cek->fetchAll(PDO::FETCH_ASSOC);

		if (count($dataUsr)) {
			echo 'double';
			return false;
		}

		// Hashing
		// $opsi   = [
		// 	'cost' => 5,
		// ];

		// $hash   = password_hash($password, PASSWORD_DEFAULT, $opsi);
		$hash   = password_hash($password, PASSWORD_DEFAULT);
		
		$sql    = "INSERT INTO member VALUES ('', '{$name}', '{$address}', '{$phone}', '{$email}', '{$hash}', '{$identity}', '{$gender}', '{$saldo}', '{$status}')";
		
		$insert = $conn->prepare($sql);
		
		$return = $insert->execute();

		echo json_encode($return);
	}
 ?>