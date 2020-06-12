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

	if (!empty($_POST['category_name']) && !empty($_POST['category_id']) && !empty($_POST['edit'])) {

		$edit          = $_POST['edit'];
		$category_id   = $_POST['category_id'];
		$category_name = $_POST['category_name'];

		if ($edit == '1') {
			$sql    = "UPDATE category SET category_name = '{$category_name}' WHERE category_id = '{$category_id}'";
			
			$update = $conn->prepare($sql);
			
			$return = $update->execute();

			echo json_encode($return);
		}
	}

	if (!empty($_POST['category_name']) && !empty($_POST['create'])) {
		$create        = $_POST['create'];
		$category_name = $_POST['category_name'];
		if ($create == '1') {
			$sql           = "INSERT INTO category VALUES ('', '{$category_name}')";
			
			$insert        = $conn->prepare($sql);
			
			$return        = $insert->execute();

			echo json_encode($return);
		}
	}

	if (!empty($_GET['get_data'])) {
		$get_data = $_GET['get_data'];

		if ($get_data == 'category') {
			$sqlCat   = "SELECT * FROM {$get_data}";
			
			$queryCat = $conn->prepare($sqlCat);
			$queryCat->execute();
			
			$dataCat  = $queryCat->fetchAll(PDO::FETCH_ASSOC);
			
			$jsonCat  = json_encode($dataCat);

			echo $jsonCat;
		}
	}

	if (!empty($_GET['get_cat']) && !empty($_GET['category_id'])) {
		$get_cat = $_GET['get_cat'];
		$cat_id  = $_GET['category_id'];

		if ($get_cat == 'category') {
			$sqlCat   = "SELECT * FROM {$get_cat} WHERE category_id = '{$cat_id}'";
			
			$queryCat = $conn->prepare($sqlCat);
			$queryCat->execute();
			
			$dataCat  = $queryCat->fetchAll(PDO::FETCH_ASSOC);
			
			$jsonCat  = json_encode($dataCat);

			echo $jsonCat;
		}
	}

	if (!empty($_GET['edit']) && !empty($_GET['id'])) {
		$edit  = $_GET['edit'];

		$id    = $_GET['id'];

		$sql   = "SELECT * FROM {$edit} WHERE category_id = {$id}";
		
		$query = $conn->prepare($sql);
		
		$query->execute();
		
		$data  = $query->fetchAll(PDO::FETCH_ASSOC);
		
		$json  = json_encode($data);
		
		echo $json;
	}

	if (!empty($_GET['delete']) && !empty($_GET['category_id'])) {
		$delete      = $_GET['delete'];

		$category_id = $_GET['category_id'];

		if ($delete == '1') {
			$sql    = "DELETE FROM category WHERE category_id = '{$category_id}'";
			
			$delete = $conn->prepare($sql);
			
			$return = $delete->execute();
			
			echo json_encode($return);
		}
	}