<?php
$servername = "localhost"; 
$username   = "root";        // default for XAMPP
$password   = "";            // default empty for XAMPP
$dbname     = "unity_foundation";

// Create connection
$conn = new mysqli("localhost", "root","", "unity_foundation");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
