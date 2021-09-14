<?php
session_start();
if (isset($_SESSION['user'])){
    echo "<h1> Je moet uitloggen</h1>";
    echo "<a href='login.php?loguit'>Log uit</a>";
}
else{
    header('location: login.html');
}
