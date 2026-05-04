<?php
require 'db.php';
$stmt = $pdo->query("SELECT id, name, hex_value FROM colors ORDER BY id ASC");
$colors = $stmt->fetchAll();

$editColor = null;
if (isset($_GET['edit_id'])) {
    $s = $pdo->prepare("SELECT id, name, hex_value FROM colors WHERE id=:id");
    $s->execute([':id' => intval($_GET['edit_id'])]);
    $editColor = $s->fetch();
}
 
$deleteColor = null;
if (isset($_GET['delete_id'])) {
    $s = $pdo->prepare("SELECT id, name, hex_value FROM colors WHERE id=:id");
    $s->execute([':id' => intval($_GET['delete_id'])]);
    $deleteColor = $s->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Color Selection</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="colors.css">
</head>
<body>

    <?php include 'fragments/header.php'; ?>

    <section class="color-title">
        <div class="color-title-bar"></div>
        <h1>Color Selection</h1>
    </section>

    <div class="add-panel">
        
        
        <?php if (isset($_GET['error'])): ?>
            <div class="error-message"><p><?= htmlspecialchars($_GET['error']) ?></p></div>
        <?php endif; ?>
    
        <h2>Add a Color</h2>

        <form method="POST" action="handler.php">
            <input type="hidden" name="action" value="add">
            <label>Color Name</label>
            <input type="text" name="color_name" maxlength="20" required>

            <label>Color Hex Value</label>
            <input type="text" name="color_hex" maxlength="7" required>

            <button type="submit" class="generate-button">Add</button>
        </form>
 
        <h2>Edit a Color</h2>

            <form method="POST" action="handler.php">
            <input type="hidden" name="action" value="edit">
            <label>Select Color</label>
            <select name="color_id">
                <option value="">— Choose a color —</option>
                    <?php foreach ($colors as $color): ?>
                        <option value="<?= $color['id'] ?>">
                            <?= htmlspecialchars($color['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>New Name</label>
                <input type="text" name="color_name" maxlength="20" required>

                <label>Color Hex Value</label>
                <input type="text" name="color_hex" maxlength="7" required>

                <button type="submit" class="generate-button">Save</button>
            </form>
    <h2>Delete Color</h2>
    <?php if ($deleteColor): ?>
    <div class="error-message"><p>Are you sure you want to delete <strong><?= htmlspecialchars($deleteColor['name']) ?></strong>?</p>
    <form method="POST" action="handler.php">
        <input type="hidden" name="action" value="delete_confirm">
        <input type="hidden" name="color_id" value="<?= $deleteColor['id'] ?>">
        <button type="submit" class="generate-button">Confirm Delete</button>
        <a href="colors.php">Cancel</a>
    </form>
    <?php else: ?>
        <form method="POST" action="handler.php">
            <input type="hidden" name="action" value="delete">
            <label>Select Color</label>
            <select name="color_id">
                <option value="">— Choose a color —</option>
                <?php foreach ($colors as $color): ?>
                    <option value="<?= $color['id'] ?>">
                        <?= htmlspecialchars($color['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="generate-button">Delete Selected</button>
        </form>
    <?php endif; ?>
    
    
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
