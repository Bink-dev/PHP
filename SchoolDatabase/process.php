<?php
$host = 'localhost';
$dbName = 'schooldatabase';
$username = 'root';
$password = '';

// Maak een nieuwe PDO-instantie
$pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Controleer of de vereiste formulier velden zijn ingevuld
    if (isset($_POST['opleidingscode'])) {
        $opleidingscode = $_POST['opleidingscode'];

        // Zoek opleidingscode in de opleiding tabel
        $query = $pdo->prepare("SELECT * FROM opleiding WHERE opleidingscode = ?");
        $query->execute([$opleidingscode]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $columns = array_keys($result);

            echo '<h3>Studenten per opleiding:</h3>';
            echo '<ul>';

            // Zoek studenten met de overeenkomende opleidingscode in stu_opl
            $query = $pdo->prepare("SELECT studentnr FROM stu_opl WHERE opleidingscode = ?");
            $query->execute([$opleidingscode]);
            $studentnrs = $query->fetchAll(PDO::FETCH_COLUMN);

            if (!empty($studentnrs)) {
                // Zoek de studentgegevens van de overeenkomende studentnummers
                $query = $pdo->prepare("SELECT roepnaam, tussenvoegsels, achternaam FROM student WHERE studentnr IN (" . implode(',', $studentnrs) . ")");
                $query->execute();
                $studenten = $query->fetchAll(PDO::FETCH_ASSOC);

                // Toon de studentgegevens in een lijst
                foreach ($studenten as $student) {
                    echo '<li>' . $student['roepnaam'] . ' ' . $student['tussenvoegsels'] . ' ' . $student['achternaam'] . '</li>';
                }
            } else {
                echo '<li>Er zijn geen studenten gevonden voor deze opleiding.</li>';
            }

            echo '</ul>';

            // Toon het formulier voor het koppelen van studenten
            echo '<h3>Studenten koppelen aan de geselecteerde opleiding:</h3>';
            echo '<form method="POST" action="">';
            echo '<label for="studentnr">Studentnummer:</label>';
            echo '<input type="text" name="studentnr" id="studentnr"><br>';
            echo '<input type="hidden" name="opleidingcode" value="' . $opleidingscode . '">';
            echo '<input type="submit" value="Koppelen">';
            echo '</form>';
        } else {
            echo 'Geen opleiding gevonden met de opgegeven opleidingscode.';
        }
    } elseif (isset($_POST['studentnr']) && isset($_POST['opleidingscode'])) {
        $studentnr = $_POST['studentnr'];
        $opleidingscode = $_POST['opleidingscode'];

        // Voeg de waarden toe aan de st_opl tabel
        $query = $pdo->prepare("INSERT INTO stu_opl (studentnr, opleidingscode) VALUES (?, ?)");
        $query->execute([$studentnr, $opleidingscode]);

        echo 'Student succesvol gekoppeld aan de opleiding.';
    } else {
        echo 'Niet alle vereiste velden zijn ingevuld.';
    }
} else {
    // Haal de opleidingscodes op uit de opleiding tabel
    $query = $pdo->query("SELECT opleidingscode, naam FROM opleiding");
    $opleidingen = $query->fetchAll(PDO::FETCH_ASSOC);

    // HTML-formulier met het dropdown-menu
    echo '<h3>Studenten per opleiding:</h3>';
    echo '<form method="POST" action="">';
    echo '<label for="opleidingscode">Opleiding:</label>';
    echo '<select name="opleidingscode" id="opleidingscode">';
    foreach ($opleidingen as $opleiding) {
        echo '<option value="' . $opleiding['opleidingscode'] . '">' . $opleiding['naam'] . '</option>';
    }
    echo '</select><br>';
    echo '<input type="submit" value="Bekijken">';
    echo '</form>';
}