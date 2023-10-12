<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    require_once(realpath(dirname(__FILE__) . '/dbh.inc.php'));
    require_once(realpath(dirname(__FILE__) . '/../models/signup.model.php'));
    require_once(realpath(dirname(__FILE__) . '/../controllers/signup.contr.php'));

    $errors = [];

    if (is_email_invalid($email)) {
        $errors['email_error'] = 'Podany email jest nieprawidłowy';
    }
    if (is_username_invalid($username)) {
        $errors['username_error'] = 'Nazwa użytkownika musi składać się od 3 do 30 znaków';
    }
    if (is_password_invalid($pwd)) {
        $errors['password_error'] = 'Hasło musi składać się z co najmniej 8 znaków';
    }
    if (is_email_unavailable($pdo, $email)) {
        $errors['email_error'] = 'Wybrany email jest już zajęty';
    }
    if (is_username_unavailable($pdo, $username)) {
        $errors['username_error'] = 'Użytkownik o danej nazwie już istnieje';
    }

    if ($errors) {
      require_once(realpath(dirname(__FILE__) . '/../config/session.config.php'));

        $_SESSION['signup_errors'] = $errors;
        header("Location: ../../public/signup.php");
    } else {
        signup_handler($pdo, $email, $username, $pwd);
    }
}
