<?php
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
        
        //left block
        echo "</select>";
        echo "</td>";
        
        //right block
        echo "<td></td>";
        echo "</tr>";
    }
echo "</table>";
?>