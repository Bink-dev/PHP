<?php
$servername = "localhost";
$database = "schooldatabase";
$username = "root";
$password = "";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo ("Connection Successful");

// Query variable
$result  = $conn->query("SELECT * FROM student");
$results = $result->fetch_all(MYSQLI_ASSOC);
foreach($results as $key => $value){
    DATA($value);
}

function DATA($input){
    echo "<pre>";
    print_r($input);
    echo "</pre>";
}