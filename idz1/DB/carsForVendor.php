<?php

require 'db.php'; 
require '../Logger/logger.php';

function getVendors() {
    try {
        global $pdo;
        
        $sql = "SELECT * FROM vendors";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return "Failed to make request: " .$e->getMessage();
    }
}

function getAvailableCars($selected_vendor) {
    try {
        global $pdo;

        $sql = "SELECT * FROM cars WHERE FID_Vendors = :selected_vendor";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':selected_vendor', $selected_vendor, PDO::PARAM_STR);
        $stmt->execute();

        logQuery('getCarsByVendor', ['selected_vendor' => $selected_vendor]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return "Failed to make request: " .$e->getMessage();
    }
}