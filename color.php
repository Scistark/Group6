<?php
require 'db.php';
$stmt = $pdo->query("SELECT name, hex_value FROM colors ORDER BY id ASC");
$colors = $stmt->fetchAll();
$max_colors  = count($colors);

$color_hex = [];
foreach ($colors as $row) {
    $color_hex[$row['name']] = $row['hex_value'];
}

$num_colors = 0;
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $rows = intval($_POST['rows']);
    $num_colors = intval($_POST['colors']);
    
    if ($rows < 1 || $rows > 26) {
        $errors[] = "Error: row/colums must be between 1 and 26";
    }
    if ($num_colors < 1 || $num_colors > $max_colors) {
        $errors[] = "Error: colors must be between 1 and $max_colors";
    }
    
}
?>
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
    <h2 class="color-heading">Grid Sizing</h2>
    <form method="POST" action="color.php">
        <label> Rows & Columns (1-26):</label>
        <input type="number" name="rows">
        <br>

        <label> Number of Colors (1-<?= $max_colors ?>):</label>
        <input type="number" name="colors">
        <br>

        <button type="submit" class="generate-button">Generate</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($errors)) {      
        echo "<div class='error-message'>";
        foreach ($errors as $msg) {
            echo "<p>$msg</p>";
        }
        echo "</div>";
    } else{
    
    include 'fragments/colorSelection.php';

    include 'fragments/coordinateGrid.php';

    echo "<br><form method='POST' action='print.php' target='_blank'>";
    echo "<input type='hidden' name='rows' value='$rows'>";
    echo "<input type='hidden' name='colors' value='$num_colors'>";
    echo "<input type='hidden' name='coord_data' id='coord-data' value=''>";
    echo "<input type='hidden' name='color_names' id='color-names' value=''>";
    echo "<button type='submit' onclick='prepPrint()'>View Printable Version</button>";
    echo "</form>";

    }
    }
    ?>
    <br>
        </div>

</body>
<script>
const hex = <?php echo json_encode($color_hex); ?>;
const coords = [];
for (let i = 0; i < <?php echo $num_colors; ?>; i++) {
    coords[i] = [];
}

function paint(cell) {
    let idx = document.querySelector('input[name="active"]:checked').value;
    let name = document.querySelectorAll('.color-dropdown')[idx].value;
    let cur = cell.getAttribute('data-coord');

    for (let i = 0; i < coords.length; i++) {
        let find = coords[i].indexOf(cur);
        if (find > -1) coords[i].splice(find, 1);
    }

    coords[idx].push(cur);
    cell.style.backgroundColor = hex[name];
    cell.setAttribute('data-owner', idx);

    for (let i = 0; i < coords.length; i++) {
            coords[i].sort(); 
            document.getElementById('list-' + i).innerText = coords[i].join(', ');
        }
}

function prepPrint() {
    document.getElementById('coord-data').value = JSON.stringify(coords);
    let names = [];
    document.querySelectorAll('.color-dropdown').forEach(d => names.push(d.value));
    document.getElementById('color-names').value = JSON.stringify(names);
}
</script>
</html>