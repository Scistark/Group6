$pdo = new PDO("mysql:host=localhost;dbname=yourdb", "user", "pass", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);