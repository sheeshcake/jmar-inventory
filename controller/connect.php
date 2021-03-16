<?php
// hostingtest
// $servername = "89.34.18.57";
// $username = "jmartest_jmar";
// $password = "I!hqGB=zWZQ&";
// $dbname = "jmartest_db";
// hosting
$servername = "localhost";
$username = "jmar_jmar";
$password = "I!hqGB=zWZQ&";
$dbname = "jmar_db";
//local
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jmar-db";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>