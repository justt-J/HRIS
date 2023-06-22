<?php
$servername = "localhost";  // Replace with your server name
$username = "your_username";  // Replace with your MySQL username
$password = "your_password";  // Replace with your MySQL password
$dbname = "your_database";  // Replace with your database name

// Create connection
$conn = new mysqli('localhost', 'root', '', 'mitsi');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Perform database operations here...

// Close the connection
$conn->close();
?>
