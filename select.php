<?php
require 'fragments/database.php';
$stmt = $pdo->query("SELECT id, name, hex_value FROM colors ORDER BY id ASC");
$colors = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Color Selector</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="select.css">
</head>
<body>

    <?php include './fragments/header.php'; ?>

    <section class="color-title">
        <div class="color-title-bar"></div>
        <h1>Color Selector</h1>
    </section>

    <div class="add-panel">
        <h2>Add Color</h2>

        <form method="POST" action="handler.php">
            <label>Color Name</label>
            <input type="text" name="color_name" maxlength="20" required>

            <label>Color Hex Value</label>
            <input type="text" name="color_hex" placeholder="#FF0000" maxlength="7" required>

            <button type="submit" class="generate-button">Add</button>
        </form>

            <div class="current-colors">
        <h2>Current Colors</h2>

        <table class="color-table">
            <tr>
                <th>Name</th>
                <th>Hex</th>
                <th>Preview</th>
            </tr>

            <?php foreach ($colors as $color): ?>
                <tr>
                    <td><?= htmlspecialchars($color['name']) ?></td>
                    <td><?= htmlspecialchars($color['hex_value']) ?></td>
                    <td>
                        <div class="color-block" style="background: <?= htmlspecialchars($color['hex_value']) ?>;"></div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    </div>

</body>
</html>
