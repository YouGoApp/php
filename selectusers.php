<?php
try {
  $conn = new PDO("mysql:host=g3v9lgqa8h5nq05o.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=r003w8gzd91dlly1", "nf7cnfvkejjel4pb", "dq9i9x5nxkgebkup");
} catch (PDOException $e){
  echo "Error ".$e->getMessage();
}

//$query = "SELECT * FROM users";

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";

$result = $conn->query($query);
if($result){
  $allowed = $result->fetchAll();
  echo json_encode($allowed);
} else {
  echo json_encode(false);
}
?>