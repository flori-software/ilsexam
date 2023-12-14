<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3>Südeuropäische Länder<br>
    mit mehr als 15.000 Einwohnern<br>
    nach Fläche absteigend sortiert<br>
    in einer Tabelle</h3>


<?php
// Verbindung zur Datenbank herstellen
$servername = "localhost";
$username = "world";
$password = "Wanderer1234";
$dbname = "world";

echo '<table>
<tr><th>Land</th><th>Fläche</th></tr>';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Fehlermodus auf Ausnahme setzen
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Vorberreitete Anweisung mit Platzhaltern
    $stmt = $conn->prepare("SELECT * FROM Country WHERE `Region` = :region AND `Population` > :population ORDER BY SurfaceArea DESC");
    
    // Wert der Platzhalter festlegen
    $region     = "Southern Europe";
    $population = 15000000;
    
    // Platzhalter mit Wert verknüpfen und Abfrage ausführen
    $stmt->bindParam(':region', $region);
    $stmt->bindParam(':population', $population);
    $stmt->execute();

    // Ergebnisse abrufen
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Ergebnisse verarbeiten
    foreach ($results as $row) {
        // Ausgabe der Ergebnisse
        echo '<tr><td>'.$row["Name"].'</td><td>'.$row["SurfaceArea"].'</td></tr>';
    }
} catch(PDOException $e) {
    echo "Verbindung fehlgeschlagen: " . $e->getMessage();
}
echo '</table>';


?>
</body>
</html>