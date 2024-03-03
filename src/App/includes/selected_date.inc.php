<?php

if (isset($_POST['date'])) {
        require_once(realpath(dirname(__FILE__) . '/../config/session.config.php'));
        regenerate_session_id_loggedin();
        
        $date = $_POST['date'];

        $_SESSION['date'] = $date;

        header('Content-Type: application/json');

        echo json_encode($date);

        die();
} else {
    header("Location: ../../public/dashboard.php");
    die();
}
