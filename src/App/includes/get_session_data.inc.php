<?php 

require_once __DIR__ . '/../config/session.config.php';

if (isset($_SESSION['date'])) {
    $date = $_SESSION['date'];
 
    header('Content-Type: application/json');
    echo json_encode(['date' => $date]);
} else {
    echo json_encode(['error' => 'Brak danych w sesji']);
}