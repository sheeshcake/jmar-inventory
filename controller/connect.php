<?php
$servername = "89.34.18.57";
$username = "jmartest_jmar";
$password = "I!hqGB=zWZQ&";
$dbname = "jmartest_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>