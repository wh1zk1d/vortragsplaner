<?php
include('../inc/db_connect.php');

// Get POST data
$talkID = $_GET['id'];

// Delete from ID
$sql = "DELETE FROM vortraege WHERE id = '$talkID'";

if (mysqli_query($db, $sql)) {
  echo "200";
} else {
  echo "500";
}
?>