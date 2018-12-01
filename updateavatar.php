<?php
	$response = 'Fail';
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_FILES['avatar'])) {
			$errors = [];
			$path = 'avatars/';
			$extensions = ['jpg', 'jpeg', 'png', 'gif'];

			$all_files = count($_FILES['avatar']['tmp_name']);

			for ($i = 0; $i < $all_files; $i++) {  
				$file_name = $_FILES['avatar']['name'][$i];
				$file_tmp = $_FILES['avatar']['tmp_name'][$i];
				$file_type = $_FILES['avatar']['type'][$i];
				$file_size = $_FILES['avatar']['size'][$i];
				$file_ext = strtolower(end(explode('.', $_FILES['avatar']['name'][$i])));

				$file = $path . $file_name;

				if (!in_array($file_ext, $extensions)) {
					$errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
				}

				if ($file_size > 2097152) {
					$errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
				}

				if (empty($errors)) {
					move_uploaded_file($file_tmp, $file);
					try {
						  $conn = new PDO("mysql:host=uoa25ublaow4obx5.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=ert3gsc64nwl3q5y", "ierrwzs0m1ehbuxk", "i66m2pr4nhu981fl");
						} catch (PDOException $e){
						  echo "Error ".$e->getMessage();
						}

						$avatar = $file;
						$username = $_POST['username'];

						$query = "UPDATE users SET avatar='$avatar' WHERE username='$username'";

						$result = $conn->query($query);
						if($result){
						  $users = $result->fetchAll();
						  echo json_encode($users);
						} else {
						  echo json_encode(false);
						}
				}
			}

			if ($errors) print_r($errors);
		}
	}