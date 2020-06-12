<?php 
	include '../../config/db.php';

	if (!empty($_GET['email'])) {
		$email       = $_GET['email'];
		$sqlMember   = "SELECT * FROM member WHERE member_email = '{$email}'";
		$queryMember = $conn->prepare($sqlMember);
		$queryMember->execute();
		$dataMember  = $queryMember->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($dataMember);
	}