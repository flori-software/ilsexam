<?php
if(isset($_POST["groesse"])) {
    $groesse = $_POST["groesse"];
    $gewicht = $_POST["gewicht"];
    $bmi = $gewicht / ($groesse / 100) ** 2;
} else {
    $groesse = 0;
    $gewicht = 0;
}
echo '<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI</title>
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
#ergebnis {
    font-size: 18px;
    font-family: Helvetica;
    font-weight: bold;
}
</style>
<body>
<h1>Body-Mass-Index berechnen</h1>
    <form method="POST" action="">
    <table>
    <tr><td>Größe in cm:</td><td><input name="groesse" value="'.$groesse.'"></td></tr>
    <tr><td>Gewicht in kg:</td><td><input name="gewicht" value="'.$gewicht.'"></td></tr>
    <tr><td></td><td><input type="submit" value="BMI berechnen"></td></tr>
    </table>
    </form>';

if(isset($bmi)) {
    echo '<p id="ergebnis">Der BMI beträgt '.number_format($bmi, 1, ",", ".").'</p>';
} else {
    echo '<p>Geben Sie Ihr Gewicht und Ihre Körpergröße in cm ein, um den BMI zu berechnen.</p>';
}

echo '</body>
</html>';
?>