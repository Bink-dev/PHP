<?php
$login=false;
$user='root';
$pass='';
$admin=false;

if ($admin==true){
    echo '<h1>Admin page</h1>';
    $login=true;

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

else{
    echo "<h1>Je hebt onvoldoende rechten!</h1>";
}
?>
