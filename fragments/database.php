<?php

$dsn = "mysql:host=helmi;dbname=NETID;charset=utf8mb4";
$user = "NETID";
$pass = "PASSWD";

//type in your user and password

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}