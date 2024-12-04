<?php
// db.php
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "oluskitchen"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Custom error message and halt the script
    die("Connection failed: " . $conn->connect_error);
}

// Optional: Set character set to UTF-8 for handling special characters
$conn->set_charset("utf8");
?>
