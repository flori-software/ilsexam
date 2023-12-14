<?php
$ergebnisse = Array();
$ergebnisse[0][0] = "*";
for($y = 0; $y <= 10; $y++) {
    if($y > 0) {$ergebnisse[$y][0] = $y;}
    for($x = 1; $x <= 10; $x++) {
        if($y == 0) {
            $ergebnisse[$y][$x] = $x;
        } else {
            $ergebnisse[$y][$x] = $y * $x;
        }
    }
}

echo "<!DOCTYPE html>\n<html lang='en'>\n<head>\n\t<meta charset='UTF-8'>\n\t<meta name='viewport' content='width=device-width, initial-scale=1.0'>\n\t<title>1 mal 1</title>\n</head>\n";

echo "<body>\n\t<h1>Das kleine 1 mal 1</h1>\n\t<table>";
foreach($ergebnisse as $key=>$zeile) {
    echo "\n\t\t<tr>";
    foreach($zeile as $key2=>$wert) {
        echo "\n\t\t\t<td";
        if($key == 0 || $key2 == 0) {
            echo " style='font-weight: bold;'";
        }
        echo ">".$wert."</td>";
    }
    echo "\n\t\t</tr>";
}

echo "\n\t</table>";
echo "\n</body>\n</html>";
?>