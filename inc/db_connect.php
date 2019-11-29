<?php
  $user     = "root";
  $password = "root";
  $hostname = "localhost";
  $dbname   = "vortragsplaner";

  $db = mysqli_connect($hostname, $user, $password, $dbname);

  if (!$db) {
    die("Fehler beim Verbinden mit der Datenbank: " . mysqli_connect_error());
  }
?>
