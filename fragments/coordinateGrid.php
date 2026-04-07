<?php
echo "<h2>Coordinate Grid</h2>";

echo "<table class='grid-table'>";
    for ($r = 0; $r <= $rows; $r++) {
        echo "<tr>";
        for ($c = 0; $c <= $rows; $c++) {
            
            if ($r == 0 && $c == 0) {
                echo "<th></th>";
            } elseif ($r == 0) {
                echo "<th>" . chr(64 + $c) . "</th>";
            } elseif ($c == 0) {
                echo "<th>$r</th>";
            } else {
                echo "<td></td>";
            }
            
        }
        echo "</tr>";
    }
echo "</table>";
?>