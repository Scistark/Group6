<?php
require 'db.php';
$stmt = $pdo->query("SELECT name, hex_value FROM colors ORDER BY id ASC");
$colors = $stmt->fetchAll();
$color_hex = [];
foreach ($colors as $row) {
    $color_hex[$row['name']] = $row['hex_value'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Printable View</title>
    <link rel="stylesheet" href="color.css">
    <style>
        body {
            filter: grayscale(100%);
        }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <header>
        <img src="resources/image.png" alt="Company Logo" style="max-width: 100px;">
        <h1>Professional Color Coordination Tools</h1>
    </header>

    <?php
    if (isset($_POST['rows']) && isset($_POST['colors'])) {
        $rows = intval($_POST['rows']);
        $num_colors = intval($_POST['colors']);
        $coord_data = isset($_POST['coord_data']) ? json_decode($_POST['coord_data'], true) : [];
        $color_names = isset($_POST['color_names']) ? json_decode($_POST['color_names'], true) : [];

        echo "<div class='print-container'>";
        echo "<h2>Color Selection</h2>";
        echo "<table class='color-table'>";
        for ($i = 0; $i < $num_colors; $i++) {
            $name = isset($color_names[$i]) ? $color_names[$i] : "Color " . ($i + 1);
            $hex = isset($color_hex[$name]) ? $color_hex[$name] : "";
            $coords = (isset($coord_data[$i]) && is_array($coord_data[$i])) ? implode(", ", $coord_data[$i]) : "";
            echo "<tr>";
            echo "<td style='width: 20%; font-weight: bold;'>" . htmlspecialchars($name) . " &mdash; " . $hex . "</td>";
            echo "<td style='width: 80%;'>$coords</td>"; 
            echo "</tr>";
        }
        echo "</table>";

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
                    echo "<th>" . $r . "</th>";
                } else {
                    echo "<td></td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
        echo "</div>";
    }
    ?>

    <br>
    <button class="no-print" onclick="window.print()">Print Page</button>

</body>
</html>