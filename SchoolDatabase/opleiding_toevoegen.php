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

// Opleiding toevoegen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $opleidingscode = $_POST['opleidingscode'];
        $naam = $_POST['naam'];
        $niveau = $_POST['niveau'];

        $stmt = $pdo->prepare("INSERT INTO opleiding (opleidingscode, naam, niveau) VALUES (:opleidingscode, :naam, :niveau)");
        $stmt->bindParam(':opleidingscode', $opleidingscode);
        $stmt->bindParam(':naam', $naam);
        $stmt->bindParam(':niveau', $niveau);
        $stmt->execute();

        echo "Opleiding is succesvol toegevoegd!";
    } catch (PDOException $e) {
        echo "Fout bij het toevoegen van de opleiding: " . $e->getMessage();
    }
}
?>