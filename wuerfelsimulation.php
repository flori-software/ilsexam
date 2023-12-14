<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Würfelsimulation</title>
</head>
<body>
<h1>Würfelsimulation</h1>    


<?php

$simulation = new Wuerfelsimulation(15);

class Wuerfelsimulation {
    public $anzahl;
    public $zahlen = Array(
        1 => 0,
        2 => 0,
        3 => 0,
        4 => 0,
        5 => 0,
        6 => 0
    );
    public $summen = Array();

    private $wuerfel = Array();

    public function __construct($anzahl) {
        $this->anzahl = $anzahl;

        // Aufruf der Methoden
        $this->wuerfe();
        $this->ausgabeErgebnisse();
    }

    private function wuerfe() {
        for($cnt = 1; $cnt <= $this->anzahl; $cnt++) {
            // Der entsprechende Key des Arrays wird initiiert, damit dann zu ihm hinzugefügt werden kann
            $this->summen[$cnt] = 0;
            for($wuerfel = 1; $wuerfel <= 3; $wuerfel++) {
                $ergebnis                      = rand(1, 6);
                $this->zahlen[$ergebnis]++;
                $this->summen[$cnt]           += $ergebnis;
                $this->wuerfel[$wuerfel][$cnt] = $ergebnis;
            }
        }
    }

    private function ausgabeErgebnisse() {
        echo '<table>
        <tr><th>Wurf-Nr.</th><th>Würfel 1</th><th>Würfel 2</th><th>Würfel 3</th><th>Summe</th></tr>';
        for($cnt = 1; $cnt <= $this->anzahl; $cnt++) {
            echo '<tr><td>'.$cnt.'</td>
            <td>'.$this->wuerfel[1][$cnt].'</td>
            <td>'.$this->wuerfel[2][$cnt].'</td>
            <td>'.$this->wuerfel[3][$cnt].'</td>
            <td>'.$this->summen[$cnt].'</td>
            </tr>';
        }
        echo '</table>';
        for($zahl = 1; $zahl <= 6; $zahl++) {
            $prozent      = round($this->zahlen[$zahl] / (3 * $this->anzahl) * 100, 2);
            echo 'Die Zahl '.$zahl.' wurde '.$this->zahlen[$zahl].' mal gewürfelt. Das sind '.$prozent.' Prozent.<br>';
            

        }
        $gesamtwert   = array_sum($this->summen);
        $durchschnitt = round($gesamtwert / $this->anzahl, 2);
        echo 'Der Gesamtwert aller Würfe beträgt '.$gesamtwert.'. Das sind durchschnittlich '.$durchschnitt.' pro Runde.';
    }
}

?>
</body>
</html>