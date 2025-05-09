<?php
$host = '127.0.0.1';
$dbname = 'lb_pdo_rent';
$username = 'root';
$password = '';

try {
    global $pdo;
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection to DB - FAIL: " . $e->getMessage();
}
?>
