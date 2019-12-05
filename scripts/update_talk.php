<?php
include('../inc/db_connect.php');

// Get POST data
$json = file_get_contents('php://input');
$data = json_decode($json);

// Save to DB
$sql = "UPDATE vortraege SET gehalten = '$data->date'  WHERE id = $data->talk";

if (mysqli_query($db, $sql)) {
  echo "200";
} else {
  echo "500";
}
?>