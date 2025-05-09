<?php

require 'logger.php';

function getAllLogs() {
    try {
        global $logPdo;

        $stmt = $logPdo->query("SELECT * FROM logs ORDER BY executed_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Failed to receive logs: " .$e->getMessage();
        return [];
    }
}

function clearLogs() {
    try {
        global $logPdo;

        $logPdo->exec("DELETE FROM logs");
        echo "Removed succesfully";
    } catch (PDOException $e) {
        echo "Remove error: " .$e->getMessage();
    }
}
?>