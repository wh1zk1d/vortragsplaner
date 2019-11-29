<?php
include('../inc/db_connect.php');

// Get POST data
$nummer = $_POST['nummer'];
$titel = $_POST['thema'];
$kategorie_id = $_POST['themenbereich'];
$gehalten = $_POST['gehalten'];

if (!$gehalten) {
  $gehalten = NULL;
}

// Save to DB
$sql = "INSERT INTO vortraege (nummer, titel, kategorie_id, gehalten) VALUES ('$nummer', '$titel', '$kategorie_id', '$gehalten')";

if (mysqli_query($db, $sql)) {
  echo "200";
} else {
  echo "500";
}
?>