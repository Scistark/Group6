<?php

$dsn = "mysql:host=helmi;dbname=snowkai;charset=utf8mb4";
$user = "snowkai";
$pass = "Sc0ut_G1nger_420";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}