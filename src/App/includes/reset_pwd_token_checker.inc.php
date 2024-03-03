<?php

declare(strict_types=1);

try {
    require_once __DIR__ . '/dbh.inc.php';
    require_once __DIR__ . '/../models/token_checker.model.php';
    require_once __DIR__ . '/../controllers/token_checker.contr.php';

    $token_hash = hash("sha256", $token);

    $token_data = check_token($pdo, $token_hash, 'reset_pwd') ?? [];

    $errors = [];

    if (is_token_doesnt_exist($token_data)) {
        $errors["token_error"] = "Token nie istnieje";
    }

    if (is_token_expired($token_data, $current_datetime)) {
        $errors["token_expiry_error"] = "Token wygasł";
    }

    if ($errors) {
        require_once __DIR__ . '/../config/session.config.php';

        $_SESSION['reset_pwd_errors'] = $errors;
    } else {
        delete_token_handler($pdo, $token_data['token'], 'reset_pwd');
    }
} catch (PDOException $e) {
    die("Wystąpił błąd: " . $e->getMessage());
}
