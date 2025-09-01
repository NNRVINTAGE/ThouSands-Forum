<?php
require_once '../../processes/database.php';
try {
    $pdo = new PDO("mysql:host=$hosts;dbname=$dbase", $names, $passw);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT bannerRefImg, refLinks FROM banners WHERE bannerState = 'active' ORDER BY bannerDates DESC");
    $slider = $stmt->fetchAll(PDO::FETCH_ASSOC);
    header('Content-Type: application/json');
    echo json_encode($slider);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
};