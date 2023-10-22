<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $todo = $_POST['todo'];

    try {
        require_once(realpath(dirname(__FILE__) . '/dbh.inc.php'));
        require_once(realpath(dirname(__FILE__) . '/../models/dashboard.model.php'));
        require_once(realpath(dirname(__FILE__) . '/../controllers/dashboard.contr.php'));
        require_once(realpath(dirname(__FILE__) . '/../config/session.config.php'));

        $user_id = $_SESSION['user_id'];

        add_todo_handler($pdo, $todo, $user_id);

        header("Location: ../../public/dashboard.php");
    } catch (PDOException $e) {
        die("Wystąpił błąd: " . $e->getMessage());
    }
} else {
    header("Location: ../../public/dashboard.php");
    die();
}
