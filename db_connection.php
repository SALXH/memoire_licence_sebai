<?php
// Database connection parameters
$servername = "localhost";
$username = "root";     // Default XAMPP username
$password = "";         // Default XAMPP password (empty)
$dbname = "contactform";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>