<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $token = $_POST['token'];
    $new_password = $_POST['new-password'];
    $new_password_confirm = $_POST['new-password-confirm'];

    $token_hash = hash("sha256", $token);
    $current_datetime = date("Y-m-d H:i:s", time());

    try {
        require_once __DIR__ . '/dbh.inc.php';
        require_once __DIR__ . '/../models/reset_password.model.php';
        require_once __DIR__ . '/../controllers/reset_password.contr.php';
        require_once __DIR__ . '/../config/session.config.php';

        $token_data = check_token($pdo, $token_hash) ?? [];

        $errors = [];

        if (is_token_doesnt_exist($token_data)) {
            $errors["token_error"] = "Token nie istnieje";
        }

        if (is_token_expired($token_data, $current_datetime)) {
            $errors["token_expiry_error"] = "Token wygasł";
        }

        if (is_password_invalid($new_password)) {
            $errors['password_error'] = 'Hasło musi składać się z co najmniej 8 znaków';
        }

        if (are_passwords_not_equal($new_password, $new_password_confirm)) {
            $errors["passwords_match_error"] = "Hasła nie są takie same.";
        }

        if ($errors) {
            $_SESSION['reset_pwd_errors'] = $errors;
            header("Location: ../../public/reset-password.php?token=$token");
        } else {
            $sanitized_password = sanitize_password($new_password);

            set_new_password($pdo, $token_data['user_email'], $sanitized_password);

            $_SESSION['reset_pwd_success'] = true;
            header("Location: ../../public/reset-password-info.php");
            exit();
        }
    } catch (PDOException $e) {
        die("Wystąpił błąd: " . $e->getMessage());
    }
} else {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}
