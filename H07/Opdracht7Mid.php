<?php
$login=false;
$user='root';
$pass='';
$admin=false;
$gebruiker=false;

if ($_POST['email']=="piet@worldonline.nl"&& $_POST['wachtwoord']=='doetje123'){
    echo '<h1>Welkom Piet, Je bent een administrator </h1>';
    $login=true;
    $gebruiker=false;
    $admin=true;

    echo '<a href="Opdracht7End.php"> CIJFERLIJST </a>';

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=phpschool;port=3306', $user, $pass);
        foreach($dbh->query('SELECT * from accounts') as $row) {

        }
        $dbh = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    die();
}

if ($_POST['email']=="klaas@carpets.nl"&& $_POST['wachtwoord']=='snoepje777'){
    echo '<h1>Welkom Klaas, Je bent een gebruiker! </h1>';
    $login=true;
    $admin=false;
    $gebruiker=true;

    try {
        $dbh = new PDO('mysql:host=localhost;dbname=phpschool; port=3306', $user, $pass);
        foreach($dbh->query('SELECT * from accounts') as $row) {

        }
        $dbh = null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }
    die();
}

else{
    echo "<h1>Naam en wachtwoord komen niet voor in database! Probeer opnieuw.</h1>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
</head>
<body>
<a href="Opdracht7End.php"> CIJFERLIJST </a>
</body>
</html>
