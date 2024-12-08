<?php
// Database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'acpr';

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Print success message
//echo "Connected successfully to $database";

// Close connection
//mysqli_close($conn);
?>