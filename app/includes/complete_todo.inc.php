<?php

if (isset($_POST['id'])) {
    try {
        require_once(realpath(dirname(__FILE__) . '/dbh.inc.php'));
        require_once(realpath(dirname(__FILE__) . '/../models/dashboard.model.php'));
        require_once(realpath(dirname(__FILE__) . '/../controllers/dashboard.contr.php'));

        $id = $_POST['id'];

        toggle_todo_checkbox_handler($pdo, $id);
    } catch (PDOException $e) {
        die("Wystąpił błąd: " . $e->getMessage());
    }
} else {
    header("Location: ../../public/dashboard.php");
    die();
}
