<?php
$servername = "localhost";
$database = "SchoolDatabase";
$username = "root";
$password = "";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo ("Connection Successful");

mysqli_close($conn);