<?php

require 'db.php'; 

function getRentRevenue($selected_date) {
    try {
        global $pdo;
        
        $sql = "SELECT SUM(Cost) AS total_income 
        FROM rent 
        WHERE Date_end = :selected_date";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':selected_date', $selected_date, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_income = $result['total_income'] ?? 0;

        return $total_income;
    } catch (PDOException $e) {
        return "Ошибка выполнения запроса: " . $e->getMessage();
    }
}
?>