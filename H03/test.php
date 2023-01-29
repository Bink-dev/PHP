<?php

$x = 5;
$y = 10;
$z = 20;
$array = [];

array_push($array, $x,$y,$z,25);

for ($i =0; $i < count($array); $i++){
    echo $array[$i] . "<br>";
}


