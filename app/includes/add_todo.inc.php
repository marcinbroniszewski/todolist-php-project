<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $todo_title = $_POST['todo-title'];
    $todo_description = $_POST['todo-description'];

    try {
        require_once(realpath(dirname(__FILE__) . '/dbh.inc.php'));
        require_once(realpath(dirname(__FILE__) . '/../models/dashboard.model.php'));
        require_once(realpath(dirname(__FILE__) . '/../controllers/dashboard.contr.php'));
        require_once(realpath(dirname(__FILE__) . '/../config/session.config.php'));
        regenerate_session_id_loggedin();
        $user_id = $_SESSION['user_id'];
        $todo_date = $_SESSION['date'];

        add_todo_handler($pdo, $todo_title, $todo_description, $todo_date, $user_id);

        header("Location: ../../public/dashboard.php");
    } catch (PDOException $e) {
        die("Wystąpił błąd: " . $e->getMessage());
    }
} else {
    header("Location: ../../public/dashboard.php");
    die();
}
