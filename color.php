<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Color Coordinator</title>
    <link rel="stylesheet" href="color.css"> 
</head>
<body>
     <header class="nav-wrapper">
        <nav class="navbar">
            <div class="nav-left">
                <img src="resources/image.png" class="logo">
                <p class="tagline">Professional Color Coordination Tools</p>
            </div>

            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="about.php">About</a>
                <a href="color.php">Color Coordinator</a>
            </div>
        </nav>
    </header>

    <h1>Color Coordinator</h1>

    <form method="POST" action="color.php">
        <label> Rows & Columns (1-26):</label>
        <input type="number" name="rows" min="1" max="26">
        <br>

        <label> Number of Colors (1-10):</label>
        <input type="number" name="colors" min="1" max="10">
        <br>

        <button type="submit" class="generate-button">Generate</button>
    </form>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $rows = intval($_POST['rows']);
    $num_colors = intval($_POST['colors']);

    $color_options = ["Red", "Orange", "Yellow", "Green", "Blue", "Purple", "Grey", "Brown", "Black", "Teal"];

    echo "<h2>Color Selection</h2>";
    
    echo "<table class='color-table'>";
    for ($i = 0; $i < $num_colors; $i++) {
        echo "<tr>";
        
        //dropdown
        echo "<td>";
        echo "<select>";
        foreach ($color_options as $index => $name) {
            $selected = ($i == $index) ? "selected" : "";
            echo "<option value='$name' $selected>$name</option>";
        }
        //leftt block
        echo "</select>";
        echo "</td>";
        
        //right block
        echo "<td></td>";
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
                echo "<th>$r</th>";
            } else {
                echo "<td></td>";
            }
            
        }
        echo "</tr>";
    }
    echo "</table>";
}
?>
    <h2>Coordinate Grid</h2>

    <button> View Printable Version </button>

</body>
</html>