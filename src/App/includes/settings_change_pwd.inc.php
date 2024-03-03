<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current-password'];
    $new_password = $_POST['new-password'];
    $confirm_password = $_POST['confirm-password'];

    try {
        require_once __DIR__ . '/dbh.inc.php';
        require_once __DIR__ . '/../models/reset_password.model.php';
        require_once __DIR__ . '/../controllers/reset_password.contr.php';
        require_once __DIR__ . '/../config/session.config.php';

        $email = $_SESSION['user_email'];
        $id = $_SESSION['user_id'];

        $errors = [];

        if (is_current_pwd_invalid($pdo, $id, $current_password)) {
            $errors['current_password'] = 'Podane aktualne hasło jest niepoprawne';
        }

        if (is_password_invalid($new_password)) {
            $errors['new_password'] = 'Podane nowe hasło jest niepoprawne';
        }

        if (are_passwords_not_equal($new_password, $confirm_password)) {
            $errors['confirm_password'] = 'Podane hasła nie są takie same';
        }

        if ($errors) {

            $jsonErrors = json_encode($errors);
            echo "
            <script>
            var errors = $jsonErrors
            var errorText = 'Wystąpiły następujące błędy:\\n';

            for (var key in errors) {
                if (errors.hasOwnProperty(key)) {
                    errorText += '- ' + errors[key] + '\\n';
                }
            }
            alert(errorText)
            window.location.href = '../../public/dashboard.php';
                </script>
                ";
        } else {
            if (isset($email)) {
                $sanitized_password = sanitize_password($new_password);
                set_new_password($pdo, $email, $sanitized_password);

                session_destroy();
                header("Location: ../../public/login.php");
            } else {
                header("Location: ../../public/dashboard.php");
            }
        }
    } catch (PDOException $e) {
        die("Wystąpił błąd: " . $e->getMessage());
    }
} else {
    header("Location: ../../public/dashboard.php");
    die();
}
