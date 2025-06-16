<?php

require 'db.php'; 

function getVendors() {
    try {
        global $pdo;
        
        $sql = "SELECT * FROM vendors";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return "Ошибка выполнения запроса: " . $e->getMessage();
    }
}

function getAvailableCars($selected_vendor) {
    try {
        global $pdo;
        
        $sql = "SELECT * FROM cars WHERE cars.FID_Vendors = :selected_vendor";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':selected_vendor', $selected_vendor, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return "Ошибка выполнения запроса: " . $e->getMessage();
    }
}
?> 