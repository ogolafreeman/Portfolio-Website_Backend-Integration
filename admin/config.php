<?php
// Database configuration
$servername = "localhost"; // Your MySQL server (usually localhost)
$username = "root"; // Your database username
$password = ""; // Your database password (default is empty for XAMPP)
$dbname = "folio"; // The name of your database

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
