<?php
$host = 'localhost';
$dbName = 'schooldatabase';
$username = 'root';
$password = '';

// Create a new PDO instance
$pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);

// Fetch all values from the 'name' column of the 'opleiding' table
$query = $pdo->prepare("SELECT name FROM opleiding");
$query->execute();
$valuesOpleiding = $query->fetchAll(PDO::FETCH_COLUMN);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedColumns = [];
    $selectedTable = 'student';
    $code = $_POST['code'];

    // Fetch columns from 'student' table that contain the specified code
    $query = $pdo->prepare("SHOW COLUMNS FROM $selectedTable LIKE '%$code%'");
    $query->execute();
    $columnsStudent = $query->fetchAll(PDO::FETCH_COLUMN);

    // Filter the columns to include only 'roepnaam', 'tussenvoegsels', and 'achternaam'
    $selectedColumns = array_intersect($columnsStudent, ['roepnaam', 'tussenvoegsels', 'achternaam']);

    // Display the columns in a list
    echo '<h3>Selected columns:</h3>';
    echo '<ul>';
    foreach ($selectedColumns as $column) {
        echo '<li>' . $column . '</li>';
    }
    echo '</ul>';

    // HTML form for linking students to a classroom
    echo '<form method="POST" action="process.php">';
    echo '<input type="hidden" name="selected_table" value="' . $selectedTable . '">';

    // Generate input fields for the selected columns
    foreach ($selectedColumns as $column) {
        echo '<label>' . $column . ': </label>';
        echo '<input type="text" name="' . $column . '"><br>';
    }

} else {
    // HTML form with a dropdown menu to select values from 'opleiding' table
    echo '<form method="POST" action="">';
    echo '<select name="code">';
    foreach ($valuesOpleiding as $value) {
        echo '<option value="' . $value . '">' . $value . '</option>';
    }
    echo '</select>';
}
echo '<input type="submit" value="Submit">';
echo '</form>';
