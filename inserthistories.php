<?php
try {
  $conn = new PDO("mysql:host=uoa25ublaow4obx5.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=ert3gsc64nwl3q5y", "ierrwzs0m1ehbuxk", "i66m2pr4nhu981fl");
} catch (PDOException $e){
  echo "Error ".$e->getMessage();
}

//$query = "SELECT * FROM users";

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$city = $_POST['city'];

$query = "INSERT INTO users (username, password, email, city) VALUES ('$username', '$password', '$email', '$city')";

$result = $conn->query($query);
if($result){
  $users = $result->fetchAll();
  echo json_encode($users);
} else {
  echo json_encode(false);
}

?>