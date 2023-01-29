<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gegevens toevoegen aan de database van school</title>
</head>
<body>

<div>
    <a></a>
</div>

</body>
</html>

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

