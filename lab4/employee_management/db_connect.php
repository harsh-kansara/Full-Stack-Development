<?php
// db_connect.php - Connection to the MySQL database

$servername = "localhost"; // Replace with your DB server (if different)
$username = "root";        // Replace with your DB username
$password = "";            // Replace with your DB password
$dbname = "employee_management"; // The database name

// Create the connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>