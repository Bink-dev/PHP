<?php
// Replace the following variables with your own database credentials
$host = 'localhost';
$dbName = 'schooldatabase';
$username = 'root';
$password = '';

// Create a new PDO instance
$pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected table from the form
    $selectedTable = $_POST['selected_table'];

    // Prepare the SQL query for inserting values into the selected table
    $query = "INSERT INTO $selectedTable (";
    $placeholders = "";
    $values = [];

    // Iterate through the submitted form data
    foreach ($_POST as $key => $value) {
        // Skip the 'selected_table' field
        if ($key === 'selected_table') {
            continue;
        }

        // Append the column name to the query
        $query .= $key . ",";

        // Append a placeholder for the column value
        $placeholders .= "?,";
        $values[] = $value;
    }

    // Remove the trailing comma from the query and placeholders
    $query = rtrim($query, ",");
    $placeholders = rtrim($placeholders, ",");

    // Complete the SQL query and execute it with the provided values
    $query .= ") VALUES ($placeholders)";
    $stmt = $pdo->prepare($query);
    $stmt->execute($values);

    echo 'Values inserted successfully!';
}
?>