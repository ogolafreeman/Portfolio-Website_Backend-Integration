<?php
// Database configuration
$servername = "localhost"; //  MySQL server (usually localhost)
$username = "root"; //  database username
$password = ""; //  database password (default is empty for XAMPP)
$dbname = "folio"; // The name of database

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
