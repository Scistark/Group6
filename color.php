<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Color Coordinator</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="color.css">
</head>
<body>
    
    <?php include 'fragments/header.php'; ?>

    <section class="color-title">
        <div class="color-title-bar"></div>
        <h1>Color Coordinator</h1>
    </section>

    <div class="color-panel">
    <h2>Grid Sizing</h2>
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
        $errors[] = "Error: row/colums must be between 1 and 26";
    }
    if ($num_colors < 1 || $num_colors > 10) {
        $errors[] = "Error: colors must be between 1 and 10";
    }
    if (!empty($errors)) {
        echo "<div class='error-message'>";
        foreach ($errors as $msg) {
            echo "<p>$msg</p>";
        }
        echo "</div>";
    } else{
    $color_options = ["Red", "Orange", "Yellow", "Green", "Blue", "Purple", "Grey", "Brown", "Black", "Teal"];

    include 'fragments/colorSelection.php';

    include 'fragments/coordinateGrid.php';

    echo "<br><a href='print.php?rows=$rows&colors=$num_colors'><button type='button'>View Printable Version</button></a>";

}
}
?>
    <br>
        </div>

</body>
</html>