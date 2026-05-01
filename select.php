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
    
    <?php include 'fragments/header.php'; ?>

    <section class="color-title">
        <div class="color-title-bar"></div>
        <h1>Color Selector</h1>
    </section>

    <div class="add-panel">
    <h2>Add Color</h2>
    <form method="POST" action="color.php">
        <label> Color Name</label>
        <input type="number" name="rows">
        <br>

        <label> Color Hex Value:</label>
        <input type="number" name="colors">
        <br>

        <button type="submit" class="generate-button">Generate</button>
    </form>

</body>
</html>