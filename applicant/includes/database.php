

<?php


// Create constants to store non-repeating values
define('SITE', 'http://localhost/URSafe(dep2.1)/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'mitsi');

// Create connection
$conn = new mysqli('localhost', 'root', '', 'mitsi');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Perform database operations here...

// Close the connection
$conn->close();
?>

