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

	if (!empty($_POST)) {

		$product_code   = $_POST['product_code'];
		$product_name   = $_POST['product_name'];
		$product_price  = $_POST['product_price'];
		$product_desc   = $_POST['product_desc'];
		$product_number = $_POST['product_number'];
		$category_id    = $_POST['category_id'];

		// echo $product_name;

		// echo $category_id;die();
		
		$sql           = "INSERT INTO product VALUES ('{$product_code}', '{$product_name}', '{$product_price}', '{$product_desc}', '{$product_number}', '{$category_id}')";
		
		$insert        = $conn->prepare($sql);
		
		$return        = $insert->execute();

		echo json_encode($return);
	}

	if (!empty($_GET['edit']) && !empty($_GET['id'])) {
		$edit  = $_GET['edit'];

		$id    = $_GET['id'];

		$sql   = "SELECT * FROM {$edit} INNER JOIN category ON product.category_id = category.category_id WHERE product_code = '{$id}'";
		
		$query = $conn->prepare($sql);
		
		$query->execute();
		
		$data  = $query->fetchAll(PDO::FETCH_ASSOC);
		
		$json  = json_encode($data);
		
		echo $json;
	}

	if (!empty($_POST['edit']) && !empty($_POST['product_code']) && !empty($_POST['product_name']) && !empty($_POST['product_price']) && !empty($_POST['product_desc']) && !empty($_POST['product_number']) && !empty($_POST['category_id'])) {

		$edit   = $_POST['edit'];
		$code   = $_POST['product_code'];
		$name   = $_POST['product_name'];
		$price  = $_POST['product_price'];
		$desc   = $_POST['product_desc'];
		$number = $_POST['product_number'];
		$catId  = $_POST['category_id'];

		if ($edit == 'product') {
			$sql    = "UPDATE {$edit} SET product_name = '{$name}', product_price = '{$price}', product_desc = '{$desc}', product_number = '{$number}', category_id = '{$catId}' WHERE product_code = '{$code}'";
			
			$update = $conn->prepare($sql);
			
			$return = $update->execute();

			echo json_encode($return);
		}
	}

	if (!empty($_GET['delete']) && !empty($_GET['product_code'])) {
		$delete       = $_GET['delete'];
		
		$product_code = $_GET['product_code'];
		
		$sql          = "DELETE FROM {$delete} WHERE product_code = '{$product_code}'";
		
		$delete       = $conn->prepare($sql);
		
		$return       = $delete->execute();
		
		echo json_encode($return);
	}

	// LIVE SEARCH
	if (!empty($_GET['search']) && !empty($_GET['keyword'])) {
		$keyword = $_GET['keyword'];
		
		$sql     = "SELECT * FROM product WHERE product_code LIKE '%{$keyword}%' OR product_name LIKE '%{$keyword}%'";
		
		$query   = $conn->prepare($sql);
		
		$query->execute();
		
		$data    = $query->fetchAll(PDO::FETCH_ASSOC);
		
		$json    = json_encode($data);
		
		echo $json;
	}