<?php
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'php_crud_app'; // Change this to your database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>