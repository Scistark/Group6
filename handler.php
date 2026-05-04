<?php

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'add';
    $name = isset($_POST['color_name']) ? trim($_POST['color_name']) : '';
    $hex  = isset($_POST['color_hex']) ? trim($_POST['color_hex']) : '';

    if ($action === 'add') {
        if ($name !== '' && $hex !== '' && preg_match('/^#[0-9A-Fa-f]{6}$/', $hex)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO colors (name, hex_value) VALUES (:name, :hex)");
            $stmt->execute([
                ':name' => $name,
                ':hex'  => $hex
            ]);
        } catch (PDOException $e) {
            header("Location: colors.php?error=That+name+or+hex+value+already+exists");
            exit;
        }
    } else {
            header("Location: colors.php?error=Invalid+name+or+hex+value");
            exit;
            
    }
    
    header("Location: colors.php");
    exit;
    } else if ($action === 'edit') {
    $id = intval($_POST['color_id']);
        if ($name !== '' && $hex !== '' && preg_match('/^#[0-9A-Fa-f]{6}$/', $hex)) {
        try {
            $stmt = $pdo->prepare("UPDATE colors SET name = :name, hex_value = :hex WHERE id = :id");
            $stmt->execute([
                ':name' => $name,
                ':hex'  => $hex,
                ':id'   => $id
            ]);
        } catch (PDOException $e) {
            header("Location: colors.php?error=That+name+or+hex+value+already+exists");
            exit;
        }
    } else {
            header("Location: colors.php?error=Invalid+name+or+hex+value");
            exit;
    }
    header("Location: colors.php");
    exit;
    } else if ($action === 'delete') {
    $id = intval($_POST['color_id']);
    $count = $pdo->query("SELECT COUNT(*) FROM colors")->fetchColumn();
    if ($count <= 2) {
            header("Location: colors.php?error=Cannot+delete%3A+must+keep+at+least+2+colors");
            exit;
        } else {
            header("Location: colors.php?delete_id=" . $id);
            exit;
        }
    }  else if ($action === 'delete_confirm') {
        $id = intval($_POST['color_id']);
        try {
            $stmt = $pdo->prepare("DELETE FROM colors WHERE id = :id");
            $stmt->execute([':id' => $id]);
            header("Location: colors.php");
        } catch (PDOException $e) {
            header("Location: colors.php?error=Could+not+delete+that+color");
        }
        header("Location: colors.php");
        exit;
    }
    } else {
    header("Location: colors.php");
    exit;
}
