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

    <p>Enter the grid size and number of colors below to generate your coordinate sheet.</p>
    <label> Rows & Columns (1-26):</label>
    <input type="number" min="1" max="26">
    <br>

    <label> Number of Colors (1-10):</label>
    <input type="number" min="1" max="10">
    <br>

    <button class="generate-button">Generate</button>

    <h2>Color Selection<h2>
    <select class="color-select">
        <option value="Red"> Red </option>
        <option value="Orange"> Orange </option>
        <option value="Yellow"> Yellow </option>
        <option value="Green"> Green </option>
        <option value="Blue"> Blue </option>
        <option value="Purple"> Purple </option>
        <option value="Grey"> Grey </option>
        <option value="Brown"> Brown </option>
        <option value="Black"> Black </option>
        <option value="Teal"> Teal </option>
    </select>

    <h2>Coordinate Grid</h2>

    <button> View Printable Version </button>

</body>
</html>