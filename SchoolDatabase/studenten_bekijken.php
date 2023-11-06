<?php
$host = 'localhost';
$dbName = 'schooldatabase';
$username = 'root';
$password = '';

// Maak een nieuwe PDO-instantie
$pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['opleidingscode'])) {
    $opleidingscode = $_POST['opleidingscode'];

    //echo $opleidingscode;
    $query = "SELECT s.studentnr, s.roepnaam, s.tussenvoegsels, s.achternaam FROM student s INNER JOIN st_opl so ON s.studentnr = so.studentnr WHERE so.opleidingscode = '" . "$opleidingscode'";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$opleidingscode]);
    $studenten = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<h3>Studenten op opleiding:</h3>';
    echo '<ul>';

    foreach ($studenten as $student) {
        echo '<li>' . $student['studentnr'] . ' ' . $student['roepnaam'] . ' ' . $student['tussenvoegsels'] . ' ' . $student['achternaam'] . '</li>';
    }

    echo '</ul>';
} else {
    echo 'Geen geldige aanvraag ontvangen.';
}
?>