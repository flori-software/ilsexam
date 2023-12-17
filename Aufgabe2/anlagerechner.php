<?php
if(isset($_POST["betrag"])) {
    $betrag   = $_POST["betrag"];
    $laufzeit = $_POST["laufzeit"];

    if($betrag > 0 && $laufzeit > 0) {
        $ergebnisse = Array();
        switch (true) {
            case ($laufzeit <= 3):
                $zins = 1.015;
            break;
            
            case ($laufzeit > 3 && $laufzeit <= 5):
                $zins = 1.025;
            break;

            case ($laufzeit > 5 && $laufzeit <= 10):
                $zins = 1.04;
            break;

            default:
                // Laufzeit > 10 Jahre 
                $zins = 1.05;
            break;
        }
        $ergebnisse[0] = $betrag;
        for($jahr = 1; $jahr <= $laufzeit; $jahr++) {
            $ergebnisse[$jahr] =  $ergebnisse[$jahr - 1] * $zins;
        }
    }
} else {
    
    $betrag   = 0;
    $laufzeit = 0;
}
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anlagerechner</title>
</head>
<style>
body {
    font-size: 18px;
    font-family: Helvetica;
}
input {
    border-radius: 10px;
    font-size: 18px;
    font-family: Helvetica;
    font-weight: lighter;
}
</style>
<body>
    <h1>Geld anlegen</h1>
    <form method="POST" action="">
    <table>
    <tr><td>Betrag:</td><td><input name="betrag" value="'.$betrag.'"></td></tr>
    <tr><td>Laufzeit:</td><td><input name="laufzeit" value="'.$laufzeit.'"></td></tr>
    <tr><td></td><td><input type="submit" value="Anlage berechnen"></td></tr>
    </table>
    </form>';

if(isset($ergebnisse)) {
    echo '<table>';
    foreach($ergebnisse as $key=>$ergebnis) {
        if($key % 2 == 0) {
            $background = "paleturquoise";
        } else {
            $background = "lightcyan";
        }
        if($key > 0) {
            echo '<tr><td style="background-color: '.$background.';">'.$key.'. Jahr</td>';
            echo '<td style="background-color: '.$background.'; text-align: right; width: 200px;">'.number_format($ergebnis, 2, ",", ".").'</td></tr>';
        }
    }
    echo '</table>';
} else {
    echo '<p>Geben Sie oben einen Betrag sowie eine Anlagelaufzeit ein, um die Verziunsung zu berechnen.</p>';
}

echo '</body>
</html>';
?>