<?php
$mysqli = new mysqli(
  "localhost",
  "c2791654_actalia",
  "pVa85RIsa31peka5",
  "c2791654_actalia"
);

if ($mysqli->connect_error) {
  die("Error: " . $mysqli->connect_error);
}

echo "Conexión OK";