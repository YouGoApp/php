<?php
try {
  $conn = new PDO("mysql:host=uoa25ublaow4obx5.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=ert3gsc64nwl3q5y", "ierrwzs0m1ehbuxk", "i66m2pr4nhu981fl");
} catch (PDOException $e){
  echo "Error ".$e->getMessage();
}

$username = $_POST['username'];

$query = "SELECT * FROM histories WHERE username='$username' ORDER BY id DESC";

$result = $conn->query($query);
if($result){
  $histories = $result->fetchAll();
  echo json_encode($histories);
} else {
  echo json_encode(false);
}

?>