<?php

declare(strict_types=1);

try {
    require_once __DIR__ . '/dbh.inc.php';
    require_once __DIR__ . '/../models/token_checker.model.php';
    require_once __DIR__ . '/../controllers/token_checker.contr.php';
    require_once __DIR__ . '/../models/signup.model.php';
    require_once __DIR__ . '/../controllers/signup.contr.php';
    require_once __DIR__ . '/../config/session.config.php';

    $token_hash = hash("sha256", $token);

    $token_data = check_token($pdo, $token_hash, 'signup_users') ?? [];

    $errors = [];

    if (is_token_doesnt_exist($token_data)) {
        $errors["token_error"] = "Token nie istnieje";
    }

    if (is_token_expired($token_data, $current_datetime)) {
        $errors["token_expiry_error"] = "Token wygasł";
    }

    if ($errors) {
        require_once __DIR__ . '/../config/session.config.php';

        $_SESSION['token_signup_errors'] = $errors;
    } else {
        create_user($pdo, $token_data['firstname'], $token_data['lastname'], $token_data['email'], $token_data['username'], $token_data['pwd']);

        delete_token_handler($pdo, $token_data['token'], 'signup_users');
    }
} catch (PDOException $e) {
    die("Wystąpił błąd: " . $e->getMessage());
}
