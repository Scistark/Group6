<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Color Coordinator</title>
    <link rel="stylesheet" href="color.css"> 
</head>
<body>
    
    <?php include 'fragments/header.php'; ?>

    <h1>Color Coordinator</h1>

    <form method="POST" action="color.php">
        <label> Rows & Columns (1-26):</label>
        <input type="number" name="rows">
        <br>

        <label> Number of Colors (1-10):</label>
        <input type="number" name="colors">
        <br>

        <button type="submit" class="generate-button">Generate</button>
    </form>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $rows = intval($_POST['rows']);
    $num_colors = intval($_POST['colors']);
    $errors = [];
    if ($rows < 1 || $rows > 26) {
        $errors[] = "error row/colums must be between 1 and 26";
    }
    if ($num_colors < 1 || $num_colors > 10) {
        $errors[] = "error colors must be between 1 and 10";
    }
    if (!empty($errors)) {
        echo "<div style='color: red; font-weight: bold;'>";
        foreach ($errors as $msg) {
            echo "<p>$msg</p>";
        }
        echo "</div>";
    } else{
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

    include 'fragments/coordinateGrid.php';
}
}
?>

    <button> View Printable Version </button>

</body>
</html>