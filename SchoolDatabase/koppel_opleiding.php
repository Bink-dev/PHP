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

// Opleiding koppelen aan student
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $studentnr = $_POST['studentnr'];
        $opleidingscode = $_POST['opleidingscode'];

        // Controleer of de student bestaat
        $stmt = $pdo->prepare("SELECT * FROM student WHERE studentnr = :studentnr");
        $stmt->bindParam(':studentnr', $studentnr);
        $stmt->execute();
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$student) {
            echo "De opgegeven student bestaat niet.";
            die();
        }

        // Student koppelen aan opleiding
        $stmt = $pdo->prepare("INSERT INTO st_opl (studentnr, opleidingscode) VALUES (:studentnr, :opleidingscode)");
        $stmt->bindParam(':studentnr', $studentnr);
        $stmt->bindParam(':opleidingscode', $opleidingscode);
        $stmt->execute();

        echo "Student succesvol gekoppeld aan de opleiding!";
    } catch (PDOException $e) {
        echo "Fout bij het koppelen van de student aan de opleiding: " . $e->getMessage();
    }
}
?>
