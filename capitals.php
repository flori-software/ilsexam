<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Städte</title>
</head>
<body>
<h1>Länder und ihre Hauptstädte</h1>
Bitte wählen Sie den Kontinent aus, dessen Länder mit Hauptstädten angezeigt werden sollen.

<?php

$abfrage = "SELECT DISTINCT `Continent` FROM `Country` ORDER BY `Continent` ASC";
$results = abfrage(abfrage: $abfrage);
$myContinent = $_POST["kontinent"] ?? "";

// Auswahlfeld
echo '<form action="#" method="POST">
Kontinent: <select name="kontinent">';
foreach ($results as $result) {
    echo '<option value="'.$result["Continent"].'" ';
    if($result["Continent"] == $myContinent) echo 'selected';
    echo '>'.$result["Continent"].'</option>';
}
echo '</select>
<input type="submit" value="anzeigen">
</form>';

// Anzeige der Ergebnisse
if($myContinent != "") {
    $abfrage = "SELECT Country.Name AS 'Land', City.Name AS 'Hauptstadt'
    FROM Country
    JOIN City ON Country.Capital = City.ID
    WHERE Country.Continent = :kontinent";
    $array_parameternamen = Array(":kontinent");
    $array_parameterwerte = Array($myContinent);
    $results = abfrage($abfrage, $array_parameternamen, $array_parameterwerte);
    echo '<table>';
    foreach ($results as $result) {
        echo '<tr><td>'.$result["Land"].'</td><td>'.$result["Hauptstadt"].'</td></tr>';
    }
    echo '</table>';
}

// Datenbankzugriff
function abfrage($abfrage, $array_parameternamen = Array(), $array_parameterwerte = Array()) {
    $servername = "localhost";
    $username = "world";
    $password = "Wanderer1234";
    $dbname = "world";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Fehlermodus auf Ausnahme setzen
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Vorberreitete Anweisung mit Platzhaltern
        $stmt = $conn->prepare($abfrage);
        
        // Platzhalter mit Wert verknüpfen und Abfrage ausführen
        if(count($array_parameternamen) == count($array_parameterwerte) && count($array_parameternamen) > 0) {
            foreach($array_parameternamen as $key=>$parameter) {
                $stmt->bindParam($parameter, $array_parameterwerte[$key]);
            }
        }
        $stmt->execute();
            
        // Ergebnisse abrufen
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    } catch(PDOException $e) {
        echo "Verbindung fehlgeschlagen: " . $e->getMessage();
    }
}

?>
</body>
</html>