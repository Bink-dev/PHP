<?php
echo "dit is opdracht 1 <br>";

for ($i = 1; $i <= 9; $i++){
    echo "<img src = '../img/aapje".$i.".jpg'>";
}

echo "<br><br>";
echo "dit is opdracht 2 <br>";

$bomen = array("boom1.jpg", "boom2.jpg", "boom3.jpg", "boom4.jpg", "boom5.jpg", "boom6.jpg", "boom7.jpg", "boom8.jpg", "boom9.jpg");

foreach($bomen as $boom){
    echo "<img src = '../img/" . $boom . "'>";
}

echo "<br><br>";
echo "dit is opdracht 3 <br>";

for($i = 0; $i <=10; $i++) {
    for($j = 0; $j<$i; $j++) {
        echo "*";
    }
    echo "<br><br>";
}

echo "dit is opdracht 4 <br>";

for($a = 35; $a >= 25; $a--){
    echo "Hoppelepee <br>";
}

echo "<br>";
echo "opdracht 5 staat als apart hoofdstuk erbij hetzelfde geld voor hoofdstuk 6 <br>";

$leeftijd = 2;

if ($leeftijd < 3) {
    echo "Je hoeft niks te betalen.";
} elseif ($leeftijd >= 3 && $leeftijd <= 12){
    echo "Je moet €5 betalen.";
} elseif ($leeftijd > 65){
    echo "Je moet €5 betalen.";
} else {
    echo "Je moet de volledige kosten van €10 betalen.";
}

echo "<br><br>";
echo "dit is opdracht 7 <br>";

$afspraak = "";
$tijd = "";
$kappersagenda = array($tijd = "9.15"=> $afspraak = "Mevr. Pietersen",
    $tijd = "9.30"=> $afspraak = "Mevr. Willems", $tijd = "9.45"=> $afspraak = "",
    $tijd = "10.00"=> $afspraak = "Paul van den Broek",
    $tijd = "10.15"=> $afspraak = "Karel de Meeuw",
    $tijd = "10.30"=> $afspraak = "");

print("De volgende momenten zijn nog beschikbaar:<ul>");
foreach ($kappersagenda as $tijd => $afspraak) {
    if($afspraak == "") {
        print("<li>".$tijd."</li>");
    }
}
print("</ul>");






