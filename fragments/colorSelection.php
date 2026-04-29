<?php
echo "<h2>Color Selection</h2>";
echo "<div id='w' style='color:red; font-weight:bold;'></div>";
echo "<table class='color-table'>";
for ($i = 0; $i < $num_colors; $i++) {
    $checked = ($i == 0) ? "checked" : "";
    echo "<tr>";
    echo "<td>";
    echo "<input type='radio' name='active' value='$i' $checked> ";
    echo "<select class='color-dropdown' data-idx='$i'>"; 
    foreach ($color_options as $index => $name) {
        $selected = ($i == $index) ? "selected" : "";
        echo "<option value='$name' $selected>$name</option>";
    }
    echo "</select></td>";
    echo "<td id='list-$i' style='width:200px;'></td>";
    echo "</tr>";
}
echo "</table>";
?>

<script>
const drops = document.querySelectorAll('.color-dropdown');
const warn = document.getElementById('w');

drops.forEach(d => {
    d.old = d.value;
    d.addEventListener('change', () => {
        let dup = false;
        drops.forEach(o => {
            if (o !== d && o.value === d.value) dup = true;
        });

        if (dup) {
            d.value = d.old;
            warn.textContent = "Error: No duplicate colors!";
        } else {
            warn.textContent = "";
            let idx = d.getAttribute('data-idx');
            let c = hex[d.value];
            let cells = document.querySelectorAll('td[data-owner="' + idx + '"]');
            cells.forEach(cell => cell.style.backgroundColor = c);
            d.old = d.value;
        }
    });
});
</script>