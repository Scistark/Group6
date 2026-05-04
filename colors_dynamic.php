<?php
header('Content-Type: text/css');
require 'db.php';
$assorted_colors = $pdo->query("SELECT name, hex_value FROM colors")->fetchAll();
foreach ($assorted_colors as $c) {
    $cls = 'cell-' . preg_replace('/[^a-zA-Z0-9]/', '-', $c['name']);
    echo ".$cls { background-color: " . htmlspecialchars($c['hex_value']) . "; }\n";
}
 