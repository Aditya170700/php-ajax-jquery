<?php 
	include '../../config/db.php';

	if (!empty($_GET['req'])) {
		$param    = $_GET['req'];
		
		$sql      = "SELECT * FROM {$param}";
		
		$query    = $conn->prepare($sql);
		$query->execute();
		
		$dataRiil = $query->fetchAll(PDO::FETCH_ASSOC);
		
		$json     = json_encode($dataRiil);

		echo $json;
	}

	if (!empty($_POST['create'])) {
		$member_name     = $_POST['member_name'];
		$member_address  = $_POST['member_address'];
		$member_phone    = $_POST['member_phone'];
		$member_email    = $_POST['member_email'];
		$member_password = $_POST['member_password'];
		$member_identity = $_POST['member_identity'];
		$member_gender   = $_POST['member_gender'];
		$member_saldo    = $_POST['member_saldo'];
		$member_status   = $_POST['member_status'];

		// Hashing
		// $opsi   = [
		// 	'cost' => 5,
		// ];

		// $hash   = password_hash($member_password, PASSWORD_DEFAULT, $opsi);
		$hash   = password_hash($member_password, PASSWORD_DEFAULT);
		
		$sql    = "INSERT INTO member VALUES ('', '{$member_name}', '{$member_address}', '{$member_phone}', '{$member_email}', '{$hash}', '{$member_identity}', '{$member_gender}', '{$member_saldo}', '{$member_status}')";
		
		$insert = $conn->prepare($sql);
		
		$return = $insert->execute();

		echo json_encode($return);
	}

	if (!empty($_GET['show']) && !empty($_GET['id'])) {
		$show  = $_GET['show'];
		$id    = $_GET['id'];
		$sql   = "SELECT * FROM {$show} WHERE member_id = {$id}";
		
		$query = $conn->prepare($sql);
		
		$query->execute();
		
		$data  = $query->fetchAll(PDO::FETCH_ASSOC);
		
		$json  = json_encode($data);
		
		echo $json;
	}

	if (!empty($_GET['edit']) && !empty($_GET['id'])) {
		$edit  = $_GET['edit'];

		$id    = $_GET['id'];

		$sql   = "SELECT * FROM {$edit} WHERE member_id = '{$id}'";
		
		$query = $conn->prepare($sql);
		
		$query->execute();
		
		$data  = $query->fetchAll(PDO::FETCH_ASSOC);
		
		$json  = json_encode($data);
		
		echo $json;
	}

	if (!empty($_POST['edit']) && !empty($_POST['member_id']) && !empty($_POST['member_name']) && !empty($_POST['member_address']) && !empty($_POST['member_phone']) && !empty($_POST['member_email']) && !empty($_POST['member_identity']) && !empty($_POST['member_gender']) && !empty($_POST['member_saldo']) && !empty($_POST['member_status']) && empty($_POST['member_password'])) {

		$edit            = $_POST['edit'];
		$member_id       = $_POST['member_id'];
		$member_name     = $_POST['member_name'];
		$member_address  = $_POST['member_address'];
		$member_phone    = $_POST['member_phone'];
		$member_email    = $_POST['member_email'];
		$member_identity = $_POST['member_identity'];
		$member_gender   = $_POST['member_gender'];
		$member_saldo    = $_POST['member_saldo'];
		$member_status   = $_POST['member_status'];

		$sql    = "UPDATE {$edit} SET member_name = '{$member_name}', member_address = '{$member_address}', member_phone = '{$member_phone}', member_email = '{$member_email}', member_identity = '{$member_identity}', member_gender = '{$member_gender}' , member_saldo = '{$member_saldo}' , member_status = '{$member_status}'  WHERE member_id = '{$member_id}'";
		
		$update = $conn->prepare($sql);
		
		$return = $update->execute();

		echo json_encode($return);

	} else if (!empty($_POST['edit']) && !empty($_POST['member_id']) && !empty($_POST['member_name']) && !empty($_POST['member_address']) && !empty($_POST['member_phone']) && !empty($_POST['member_email']) && !empty($_POST['member_identity']) && !empty($_POST['member_gender']) && !empty($_POST['member_saldo']) && !empty($_POST['member_status']) && !empty($_POST['member_password'])) {

		$edit            = $_POST['edit'];
		$member_id       = $_POST['member_id'];
		$member_name     = $_POST['member_name'];
		$member_address  = $_POST['member_address'];
		$member_phone    = $_POST['member_phone'];
		$member_email    = $_POST['member_email'];
		$member_identity = $_POST['member_identity'];
		$member_gender   = $_POST['member_gender'];
		$member_saldo    = $_POST['member_saldo'];
		$member_status   = $_POST['member_status'];
		$member_password = $_POST['member_password'];

		// Hashing
		$opsi   = [
			'cost' => 5,
		];

		$hash   = password_hash($member_password, PASSWORD_DEFAULT, $opsi);

		$sql    = "UPDATE {$edit} SET member_name = '{$member_name}', member_address = '{$member_address}', member_phone = '{$member_phone}', member_email = '{$member_email}', member_identity = '{$member_identity}', member_gender = '{$member_gender}' , member_saldo = '{$member_saldo}' , member_status = '{$member_status}', member_password = '{$hash}'  WHERE member_id = '{$member_id}'";
		
		$update = $conn->prepare($sql);
		
		$return = $update->execute();

		echo json_encode($return);
	}

	if (!empty($_GET['delete']) && !empty($_GET['member_id'])) {
		$delete    = $_GET['delete'];
		
		$member_id = $_GET['member_id'];
		
		$sql       = "DELETE FROM {$delete} WHERE member_id = '{$member_id}'";
		
		$delete    = $conn->prepare($sql);
		
		$return    = $delete->execute();
		
		echo json_encode($return);
	}