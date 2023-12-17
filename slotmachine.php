<?php
session_start();
echo '<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slotmachine</title>
</head>
<body>
<h1>Slotmachine</h1>';
// Übermittelte Werte
$spiel = $_GET["spiel"] ?? false;
if($spiel) {
    $einsatz               = $_POST["einsatz"] ?? 0;
    $_SESSION["guthaben"] -= $einsatz;
} else {
    $_SESSION["guthaben"] = 10000;
}

if($_SESSION["guthaben"] > 100) {
    $einsatzvorschlag = 100;
} else {
    $einsatzvorschlag =  $guthaben;
}

// Felder 1 bis 3
$felder  = array();
$felder[0] = random_int(1, 8);
$felder[1] = random_int(1, 8);
$felder[2] = random_int(1, 8);

if($spiel) {
    // Anzahl der gleichen Werte wird ermittelt
    $anzahl_gleiche_werte = array_count_values($felder);

    // Nun wird der höchste Wert aus dieser ermittelt, denn wir haben an dieser Stelle ein Array mit möglichen Werten 1, 1, 1 oder 2, 1 oder 3
    $ergebnis = max($anzahl_gleiche_werte);
    switch ($ergebnis) {
        case '2':
            echo '<p>Doppeltreffer!</p>';
            $_SESSION["guthaben"] += 2 * $einsatz;
        break;

        case '3':
            echo '<p>Dreifachtreffer!</p>';
            $_SESSION["guthaben"] += 3 * $einsatz;
        break;
    }

}

$max_einsatz = $_SESSION["guthaben"];

foreach ($felder as $key => $feld) {
    echo '<input name="feld'.$key.'" value="'.$feld.'" disabled>&nbsp;';
}
echo '<p>Guthaben:</p>
<form action="slotmachine.php?spiel=true" method="POST">
<input value="'.$_SESSION["guthaben"].'" disabled>
<p>Ihr Einsatz bitte:</p>
<input type="number" name="einsatz" min="1" min="1" max="'.$max_einsatz.'" value="'.$einsatzvorschlag.'">
<p>
<table>
<tr><td><input type="submit" value="Spielen" style="inline-block;"></td>
</form>
<form action="#">
<td><input type="submit" value="Neues Spiel" style="inline-block;"></td></tr></table>
</form>
</p>';
echo '</body></html>';
?>