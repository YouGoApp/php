<?php
try {
  $conn = new PDO("mysql:host=g3v9lgqa8h5nq05o.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=r003w8gzd91dlly1", "nf7cnfvkejjel4pb", "dq9i9x5nxkgebkup");
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