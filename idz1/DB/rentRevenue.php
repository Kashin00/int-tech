<?php

require 'db.php'; 
require '../Logger/logger.php';

function getRentRevenue($selected_date) {
    try {
        global $pdo;
        
        $sql = "SELECT SUM(Cost) AS total_income 
        FROM rent 
        WHERE Date_end = :selected_date";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':selected_date', $selected_date, PDO::PARAM_STR);
        $stmt->execute();

        logQuery('rentRevenue', ['selected_date' => $selected_date]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_income = $result['total_income'] ?? 0;

        return $total_income;
    } catch (PDOException $e) {
        return "Failed to make request: " .$e->getMessage();
    }
}
?>