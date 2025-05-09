<?php
try {
    $dbPath = __DIR__ . '/log.sqlite';
    $pdo = new PDO("sqlite:$dbPath");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "
        CREATE TABLE IF NOT EXISTS logs (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            query_name TEXT NOT NULL,
            params TEXT,
            executed_at TEXT NOT NULL
        );
    ";

    $pdo->exec($sql);

    echo "SUCCESS: $dbPath";
} catch (PDOException $e) {
    echo "ERROR: " .$e->getMessage();
}
?>