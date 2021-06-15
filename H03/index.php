<?php

for ($i = 1; $i <= 9; $i++){
    echo "<img src = '../img/aapje".$i.".jpg'>" . "<Br><Br>";
}

$bomen = array("boom1.jpg", "boom2.jpg", "boom3.jpg", "boom4.jpg", "boom5.jpg", "boom6.jpg", "boom7.jpg", "boom8.jpg", "boom9.jpg");

foreach($bomen as $boom){
    echo "<img src = '../img/" . $boom . "'>" . "<Br><Br>";
}





