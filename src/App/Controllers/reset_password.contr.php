<?php

declare(strict_types=1);

function are_passwords_not_equal(string $password, string $password_confirm)
{
    if ($password !== $password_confirm) {
        return true;
    } else {
        return false;
    }
}

function is_password_invalid(string $password)
{
    if (strlen($password) >= 8 && strlen($password) <= 255) {
        return false;
    } else {
        return true;
    }
}

function sanitize_password(string $password) {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    
    return $hashed_password;
}
function set_new_password(object $pdo, string $email, $sanitized_password) {
    update_password($pdo, $email, $sanitized_password);
}

// settings_change_pwd.inc.php
function is_current_pwd_invalid(object $pdo, string $id, string $provided_password) {
    $current_password = check_password($pdo, $id);

    if (password_verify($provided_password, $current_password)) {
        return false;
    } else {
        return true;
    }
}