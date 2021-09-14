<?php
session_start();
if ($_POST['email']=="test"&& $_POST['wachtwoord']=='test') {
    echo '<h1>Welkom test,</h1>';
    $_SESSION['user'] = $_POST['email'];
    print_r($_SESSION);
    echo "<a href='user.php'><br>website<br></a>";
    echo "<a href='admin.php'>Admin Panel<br></a>";
    echo "<a href='login.php'>Log uit<br></a>";
    die();
}
if ($_POST['email']=="admin"&& $_POST['wachtwoord']=='admin') {
    echo '<h1>Welkom Admin,</h1>';
    $_SESSION['user'] = $_POST['email'];
    $_SESSION['admin']="ja";
    print_r($_SESSION);
    echo "<a href='website.php'><br>website<br></a>";
    echo "<a href='admin.php'>Admin Panel<br></a>";
    echo "<a href='login.php'>Log uit<br></a>";
    die();
}

if (isset($_GET['loguit'])){
    $_SESSION = array();
    session_destroy();
}

else{
    echo "<h1>Sorry, geen toegang</h1>";
    echo "<a href='start.html'><br>terug<br></a>";
    $login=false;
}

