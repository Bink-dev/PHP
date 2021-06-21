<?php

echo "dit is opdracht 1 <br>";

echo  " 34 Graden celsius is gelijk aan " . celsiusNaarFahrenheit(34) . " Fahrenheit";

function celsiusNaarFahrenheit($a){
    $a = $a * 1.8 + 32;
    return $a;
}
echo "<br><br>";
echo "dit is opdracht 2 <br>";


echo isGetalDeelbaarDoorDrie(48);

function isGetalDeelbaarDoorDrie($a){
    if ($a % 3 == 0) {
        return "true";
    } else {
        return "false";
    }}

echo "<br><br>";
echo "dit is opdracht 3 <br>";

echo reverse ("thcardpo ed si tiD");

function reverse ($string) {
    return strrev ($string);}



