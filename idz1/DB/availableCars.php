<?php

require 'db.php'; 
require '../Logger/logger.php';

function getAvailableCars($selected_date) {
    try {
        global $pdo;

        $sql = "SELECT * FROM cars WHERE cars.ID_Cars NOT IN (
            SELECT FID_Car FROM rent 
            WHERE (Date_start <= :selected_date AND Date_end >= :selected_date)
        )";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':selected_date', $selected_date, PDO::PARAM_STR);
        $stmt->execute();

        logQuery('getAvailableCars', ['selected_date' => $selected_date]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return "Failed to make request: " . $e->getMessage();
    }
}
?>