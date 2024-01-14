<?php

declare(strict_types=1);

function is_token_doesnt_exist(?array $token_data)
{
    if (empty($token_data) || empty($token_data['token'])) {
        return true;
    } else {
        return false;
    }
}

function is_token_expired(?array $token_data, string $current_datetime)
{
    if (empty($token_data) || empty($token_data['token_expiry'])) {
        return true;
    } 

    $token_datetime_timestamp = strtotime($token_data['token_expiry']);
    $current_datetime_timestamp = strtotime($current_datetime);

    $token_date = date('Y-m-d', $token_datetime_timestamp);
    $current_date = date('Y-m-d', $current_datetime_timestamp);

    $token_time = date('H:i:s', $token_datetime_timestamp);
    $current_time = date('H:i:s', $current_datetime_timestamp);

    if ($token_date === $current_date && $token_time > $current_time) {
        return false;
    } else {
        return true;
    }
}

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

function check_token(object $pdo, string $token)
{
    $token_data = get_token_data($pdo, $token);

    if ($token_data !== false) {
        return $token_data;
    } else {
        return [];
    }
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