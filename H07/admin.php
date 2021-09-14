<?php
session_start();

if (isset($_SESSION['user']) && $_SESSION["admin"]){
    echo "<h1> Welkom admin!</h1>";
    echo "<a href='start.html'>Log uit</a>";
}

else {
    echo "<h1>U bent geen administrator!</h1>";
    echo "<h3> U heeft onvoldoende rechten </h3>";
}