<?php
// Database connection file
$host = 'localhost';
$user = 'root';  // MySQL username
$password = '';  // MySQL password
$db_name = 'student_registration'; // Database name

$conn = new mysqli($host, $user, $password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>