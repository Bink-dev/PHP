<?php
$host = 'localhost';
$dbName = 'schooldatabase';
$username = 'root';
$password = '';

// Maak een nieuwe PDO-instantie
$pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['opleidingscode'])) {
        $opleidingscode = $_POST['opleidingscode'];

        $stmt = $pdo->prepare("SELECT * FROM opleiding WHERE opleidingscode = ?");
        $stmt->execute([$opleidingscode]);
        $opleiding = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($opleiding) {
            $stmt = $pdo->prepare("SELECT s.roepnaam, s.tussenvoegsels, s.achternaam FROM student s INNER JOIN stu_opl so ON s.studentnr = so.studentnr WHERE so.opleidingscode = ?");
            $stmt->execute([$opleidingscode]);
            $studenten = $stmt->fetchAll(PDO::FETCH_ASSOC);

            echo '<ul>';

            foreach ($studenten as $student) {
                echo '<li>' . $student['roepnaam'] . ' ' . $student['tussenvoegsels'] . ' ' . $student['achternaam'] . '</li>';
            }

            echo '</ul>';
        } else {
            echo 'Opleidingscode niet gevonden in de database.';
        }
    } elseif (isset($_POST['studentnr'], $_POST['opleidingscode'])) {
        $studentnr = $_POST['studentnr'];
        $opleidingscode = $_POST['opleidingscode'];

        $stmt = $pdo->prepare("SELECT * FROM student WHERE studentnr = ?");
        $stmt->execute([$studentnr]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $stmt = $pdo->prepare("INSERT INTO stu_opl (studentnr, opleidingscode) VALUES (?, ?)");
            $stmt->execute([$studentnr, $opleidingscode]);

            echo 'Student succesvol gekoppeld aan de opleiding.';
        } else {
            echo 'Studentnummer bestaat niet in de database.';
        }
    } else {
        echo 'Niet alle vereiste velden zijn ingevuld.';
    }
} else {
    $stmt = $pdo->query("SELECT opleidingscode, naam FROM opleiding");
    $opleidingen = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<h3>Studenten per opleiding:</h3>';
    echo '<form method="POST" action="">';
    echo '<label for="opleidingscode">Opleiding:</label>';
    echo '<select name="opleidingscode" id="opleidingscode">';

    foreach ($opleidingen as $opleiding) {
        echo '<option value="' . $opleiding['opleidingscode'] . '">' . $opleiding['naam'] . '</option>';
    }

    echo '</select>';
    echo '<input type="submit" value="Bekijken">';
    echo '</form>';

    echo '<h3>Studenten koppelen aan opleiding:</h3>';
    echo '<form method="POST" action="">';
    echo '<label for="studentnr">Studentnummer:</label>';
    echo '<input type="text" name="studentnr" id="studentnr"><br>';
    echo '<label for="opleidingscode">Opleiding:</label>';
    echo '<select name="opleidingscode" id="opleidingscode">';

    foreach ($opleidingen as $opleiding) {
        echo '<option value="' . $opleiding['opleidingscode'] . '">' . $opleiding['naam'] . '</option>';
    }

    echo '</select>';
    echo '<input type="submit" value="Koppelen">';
    echo '</form>';

    echo '<h3>Student toevoegen:</h3>';
    echo '<form method="POST" action="student_toevoegen.php">';

    $stmt = $pdo->query("DESCRIBE student");
    $kolommen = $stmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($kolommen as $kolom) {
        echo '<label for="' . $kolom . '">' . $kolom . ':</label>';
        echo '<input type="text" name="' . $kolom . '" id="' . $kolom . '"><br>';
    }

    echo '<input type="submit" value="Toevoegen">';
    echo '</form>';

    echo '<h3>Opleiding toevoegen:</h3>';
    echo '<form method="POST" action="opleiding_toevoegen.php">';

    $stmt = $pdo->query("DESCRIBE opleiding");
    $kolommen = $stmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($kolommen as $kolom) {
        echo '<label for="' . $kolom . '">' . $kolom . ':</label>';
        echo '<input type="text" name="' . $kolom . '" id="' . $kolom . '"><br>';
    }

    echo '<input type="submit" value="Toevoegen">';
    echo '</form>';
}
?>