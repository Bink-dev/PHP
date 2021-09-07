<?php
try {
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "phpschool";

    $db = new PDO("mysql:host=" . $host . ";dbname=" . $database, $user, $password);
} catch (PDOException $error) {
    echo $error->getMessage();
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulier PHP</title>
</head>
<body>

<form action="Opdracht7Mid.php" method="POST">
    Email <input type="text" name="email" value="">
    Wachtwoord <input type="password" name="wachtwoord" value="">
    <input type="submit" name="knop" value="verstuur">
</form>

</body>
</html>
