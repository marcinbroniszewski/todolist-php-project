<?php

if (isset($_POST['id']) && isset($_POST['title'])) {
    try {
        require_once(realpath(dirname(__FILE__) . '/dbh.inc.php'));
        require_once(realpath(dirname(__FILE__) . '/../models/dashboard.model.php'));
        require_once(realpath(dirname(__FILE__) . '/../controllers/dashboard.contr.php'));

        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];

        edit_todo_handler($pdo, $id, $title, $description);
    } catch (PDOException $e) {
        die("Wystąpił błąd: " . $e->getMessage());
    }
} else {
    header("Location: ../../public/dashboard.php");
    die();
}
