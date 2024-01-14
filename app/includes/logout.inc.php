<?php
declare(strict_types=1);
ob_start();

$response = [];

if (isset($_POST['logout'])) {
    require_once(realpath(dirname(__FILE__) . '/../config/session.config.php'));
    
    session_destroy();

    $response['success'] = true;
} else {
    $response['success'] = false;
}

ob_end_clean();
header('Content-Type: application/json');
echo json_encode($response);
exit();
?>