<?php

require 'db.php'; 

function getAvailableCars($selected_date) {
    try {
        global $pdo;
        
        $sql = "SELECT * FROM cars WHERE cars.ID_Cars NOT IN (SELECT FID_Car FROM rent WHERE (Date_start <= :selected_date AND Date_end >= :selected_date))";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':selected_date', $selected_date, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return "Ошибка выполнения запроса: " . $e->getMessage();
    }
}
?>