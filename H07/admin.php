<?php
session_start();
echo "Administration <br>";

if (isset($_SESSION['user']) && $_SESSION["admin"]){
    echo "<h1> Welkom Admin</h1>";
    echo "<a href='Opdracht7.1.php'>Log uit</a>";
}

else {
    echo 'you do not have enough permission to view this webpage';
}