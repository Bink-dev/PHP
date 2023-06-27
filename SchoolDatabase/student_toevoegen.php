<?php
// Databaseverbinding instellen
$host = 'localhost';
$dbname = 'schooldatabase';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Fout bij het verbinden met de database: " . $e->getMessage();
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $values = array();
    $placeholders = array();

    foreach ($_POST as $key => $value) {
        $values[$key] = $value;
        $placeholders[$key] = ':' . $key;
    }

    $columns = implode(', ', array_keys($values));
    $params = implode(', ', $placeholders);

    // Voeg de student toe aan de database
    try {
        $stmt = $pdo->prepare("INSERT INTO student ($columns) VALUES ($params)");
        $stmt->execute($values);

        echo "Student succesvol toegevoegd!";
    } catch (PDOException $e) {
        echo "Fout bij het toevoegen van de student: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nieuwe student toevoegen</title>
</head>
<body>
    <h1>Nieuwe student toevoegen</h1>
    <form method="POST" action="student_toevoegen.php">
        <?php
        // Dynamisch genereren van invoervelden voor elke kolom in de tabel student
        $query = $pdo->query("DESCRIBE student");
        $columns = $query->fetchAll(PDO::FETCH_COLUMN);
        foreach ($columns as $column) {
            echo "<label for='$column'>$column:</label>";
            echo "<input type='text' name='$column' required><br>";
        }
        ?>
        <input type="submit" value="Toevoegen aan database">
    </form>
</body>
</html>