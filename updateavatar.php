<?php
	$response = 'Fail';
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		if (isset($_FILES['avatar'])) {
			$errors = [];
			$path = 'avatars/';
			$extensions = ['jpg', 'jpeg', 'png', 'gif'];

			$file_name = $_FILES['avatar']['name'];
			$file_tmp = $_FILES['avatar']['tmp_name'];
			$file_type = $_FILES['avatar']['type'];
			$file_size = $_FILES['avatar']['size'];
			$fileParts = explode('.', $_FILES['avatar']['name']);
			$file_ext = strtolower(end($fileParts));
			$file = $path . $_POST['username'].'-'.$file_name;

			if (!in_array($file_ext, $extensions)) {
				$errors[] = 'Extension not allowed: ' . $file_name . ' ' . $file_type;
			}

			if ($file_size > 2097152) {
				$errors[] = 'File size exceeds limit: ' . $file_name . ' ' . $file_type;
			}

			if (empty($errors)) {
				move_uploaded_file($file_tmp, $file);
				try {
					$conn = new PDO("mysql:host=g3v9lgqa8h5nq05o.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=r003w8gzd91dlly1", "nf7cnfvkejjel4pb", "dq9i9x5nxkgebkup");
					} catch (PDOException $e){
					  echo "Error ".$e->getMessage();
					}

					$avatar = $file;
					$username = $_POST['username'];

					$query = "UPDATE users SET avatar='$avatar' WHERE username='$username'";
					
					$result = $conn->query($query);
					if($result){
						$response = (object) ['avatar' => $avatar];
						echo json_encode($response);
					} else {
					  echo json_encode(false);
					}
			}

			if ($errors) print_r($errors);
		}
	}