<?php 
	include '../../config/db.php';

	if (!empty($_POST['cart']) && $_POST['cart'] == 'add-cart' && !empty($_POST['idCartProduct']) && !empty($_POST['amountCartProduct']) && !empty($_POST['email'])) {
		$id     = $_POST['idCartProduct'];
		$amount = $_POST['amountCartProduct'];
		$email  = $_POST['email'];

		// Select member
		$sqlMember   = "SELECT * FROM member WHERE member_email = '{$email}'";
		$queryMember = $conn->prepare($sqlMember);
		$queryMember->execute();
		$dataMember  = $queryMember->fetchAll(PDO::FETCH_ASSOC);

		// Check cart
		$sqlCheck   = "SELECT * FROM cart WHERE member_id = '{$dataMember[0]['member_id']}' AND product_code = '{$id}'";
		$queryCheck = $conn->prepare($sqlCheck);
		$queryCheck->execute();
		$dataCheck  = $queryCheck->fetchAll(PDO::FETCH_ASSOC);

		if ($dataCheck == null) {
			$sqlInsert    = "INSERT INTO cart VALUES ('', '{$id}', 1, '{$dataMember[0]['member_id']}')";
			$insertCart   = $conn->prepare($sqlInsert);
			$returnInsert = $insertCart->execute();
			echo json_encode($returnInsert);
		} else {
			$tambah       = $dataCheck[0]['cart_qty'] + 1;
			$sqlUpdate    = "UPDATE cart SET cart_qty = '{$tambah}' WHERE cart_id = '{$dataCheck[0]['cart_id']}'";
			$updateCart   = $conn->prepare($sqlUpdate);
			$returnUpdate = $updateCart->execute();
			echo json_encode($returnUpdate);
		}
	}

	if (!empty($_GET['cart']) && $_GET['cart'] == 'get-data' && !empty($_GET['email'])) {
		$email = $_GET['email'];

		// Select member
		$sqlMember   = "SELECT * FROM member WHERE member_email = '{$email}'";
		$queryMember = $conn->prepare($sqlMember);
		$queryMember->execute();
		$dataMember  = $queryMember->fetchAll(PDO::FETCH_ASSOC);

		// Check cart
		$sqlCheck   = "SELECT cart.*, product.* FROM cart INNER JOIN product ON cart.product_code = product.product_code WHERE member_id = '{$dataMember[0]['member_id']}'";
		$queryCheck = $conn->prepare($sqlCheck);
		$queryCheck->execute();
		$dataCheck  = $queryCheck->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($dataCheck);
	}

	if (!empty($_POST['cart']) && $_POST['cart'] == 'checkout') {
		$amount         = $_POST['amount'];
		$qty            = $_POST['count_items'];
		$product_code   = $_POST['product_code'];
		$email          = $_POST['member_email'];
		$order_date     = date('Y-m-d');
		
		$sqlGetMember   = "SELECT * FROM member WHERE member_email = '{$email}'";
		$queryGetMember = $conn->prepare($sqlGetMember);
		$queryGetMember->execute();
		$dataMember     = $queryGetMember->fetchAll(PDO::FETCH_ASSOC);
		
		$sqlInsert      = "INSERT INTO ordering VALUES ('', '{$order_date}', '{$amount}', '{$qty}', '{$product_code}', '{$dataMember[0]['member_id']}')";
		$insertCart     = $conn->prepare($sqlInsert);
		$returnInsert   = $insertCart->execute();

		$sqlDeleteCart	= "DELETE FROM cart WHERE product_code = '${product_code}' AND member_id = '{$dataMember[0]['member_id']}'";
		$deleteCart 	= $conn->prepare($sqlDeleteCart);
		$returnDelete	= $deleteCart->execute();
		
		echo json_encode($returnInsert);
	}