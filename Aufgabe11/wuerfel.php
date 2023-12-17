<?php
session_start();
echo '<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Würfel</title>
</head>
<body>
<h1>Würfeln</h1>';

if(!isset($_SESSION["summe"])) {
    $_SESSION["summe"]  = 0;
    $_SESSION["anzahl"] = 0;
}

$wurf = random_int(min: 1, max: 6);
$_SESSION["anzahl"]++;
$_SESSION["summe"] += $wurf;

echo '<p>Wurf '.$_SESSION["anzahl"].': '.$wurf.'</p>';
echo '<p>Die Summe der gewürfelten Zahlen beträgt '.$_SESSION["summe"].'</p>';
echo '<img src="'.$wurf.'.jpg">';
echo '<br><form action="#" method="POST">
<input type="submit" value="Würfeln">
</form>';
echo '</body></html>';

?>