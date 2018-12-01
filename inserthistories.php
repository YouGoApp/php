<?php
try {
  $conn = new PDO("mysql:host=uoa25ublaow4obx5.cbetxkdyhwsb.us-east-1.rds.amazonaws.com;dbname=ert3gsc64nwl3q5y", "ierrwzs0m1ehbuxk", "i66m2pr4nhu981fl");
} catch (PDOException $e){
  echo "Error ".$e->getMessage();
}

//$query = "SELECT * FROM users";

$name = $_POST['name'];
$price = $_POST['price'];
$address = $_POST['address'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$place_id = $_POST['place_id'];
$photo_references = $_POST['photo_references'];

$query = "INSERT INTO histories (name, price, address, latitude, longitude, place_id, photo_references) VALUES ('$name', '$price', '$address', '$latitude', '$longitude', '$place_id', '$photo_references')";

$result = $conn->query($query);
if($result){
  $histories = $result->fetchAll();
  echo json_encode($histories);
} else {
  echo json_encode(false);
}

?>