<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    try {
        require_once(realpath(dirname(__FILE__) . '/dbh.inc.php'));
        require_once(realpath(dirname(__FILE__) . '/../models/login.model.php'));
        require_once(realpath(dirname(__FILE__) . '/../controllers/login.contr.php'));

        $errors = [];

        $user_data = get_user_data($pdo, $username);

        if (is_username_incorrect($user_data)) {
            $errors['username_error'] = 'Nazwa użytkownika jest nieprawidłowa';
        }

        if (is_password_incorrect($pwd, $user_data)) {
            $errors['password_error'] = 'Podane hasło jest nieprawidłowe';
        }

        require_once(realpath(dirname(__FILE__) . '/../config/session.config.php'));
        
        if ($errors) {
            $_SESSION['login_errors'] = $errors;

            header("Location: ../../public/login.php");
            die();
        } else {
            $_SESSION['user_id'] = $user_data['id'];

            header("Location: ../../public/dashboard.php");
            die();
        }
    } catch (PDOException $e) {
        die("Wystąpił błąd: " . $e->getMessage());
    }
} else {
    header("Location: ../../public/login.php");
    die();
}
