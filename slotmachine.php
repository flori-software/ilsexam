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

} else {
    $_SESSION["guthaben"] = 10000;
}

$max_einsatz = $_SESSION["guthaben"];
if($guthaben > 100) {
    $einsatzvorschlag = 100;
} else {
    $einsatzvorschlag =  $guthaben;
}



// Felder 1 bis 3
$felder  = array();
$felder[0] = random_int(1, 8);
$felder[1] = random_int(1, 8);
$felder[2] = random_int(1, 8);

foreach ($felder as $key => $feld) {
    echo '<input name="feld'.$key.'" value="'.$feld.'" disabled>&nbsp;';
}
echo '<p>Guthaben:</p>
<form action="slotmachine.php?spiel=1" method="POST">
<input value="'.$_SESSION["guthaben"].'" disabled>
<p>Ihr Einsatz bitte: '.$max_einsatz.'</p>
<input type="number" name="einsatz" min="1" min="1" max="'.$max_einsatz.'" value="'.$einsatzvorschlag.'">
<p>
<input type="submit" value="Spielen">&nbsp;
</form>
<form action="#">
<input type="submit" value="Neues Spiel">
</form>
</p>';




    
echo '</body></html>';
?>