<?php
// Database connection
$servername = "db"; // Docker service name
$username = "root";
$password = "joyel1234";
$dbname = "music";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
