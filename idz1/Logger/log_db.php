<?php
try {
    global $logPdo;
    $logPdo = new PDO("sqlite:" . __DIR__ . "/log.sqlite");
    $logPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection to LOG DB - FAIL: " . $e->getMessage();
}
?>