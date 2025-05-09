<?php

require 'log_db.php';

function logQuery($query_name, $parameters) {
    try {
        global $logPdo;

        $sql = "INSERT INTO logs (query_name, params, executed_at) VALUES (:query_name, :params, :executed_at)";
        $stmt = $logPdo->prepare($sql);

        $executed_at = date('Y-m-d H:i:s');

        $stmt->execute([
            ':query_name' => $query_name,
            ':params' => json_encode($parameters, JSON_UNESCAPED_UNICODE),
            ':executed_at' => $executed_at
        ]);
    } catch (PDOException $e) {
        echo "Failed to log query: " .$e->getMessage();
    }
}
?>