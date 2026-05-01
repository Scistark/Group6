<?php

require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['color_name']) ? trim($_POST['color_name']) : '';
    $hex  = isset($_POST['color_hex']) ? trim($_POST['color_hex']) : '';

    if ($name !== '' && $hex !== '' && preg_match('/^#[0-9A-Fa-f]{6}$/', $hex)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO colors (name, hex_value) VALUES (:name, :hex)");
            $stmt->execute([
                ':name' => $name,
                ':hex'  => $hex
            ]);
        } catch (PDOException $e) {
        }
    }

    header("Location: select.php");
    exit;
} else {
    header("Location: select.php");
    exit;
}
