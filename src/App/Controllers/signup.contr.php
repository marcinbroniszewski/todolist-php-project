<?php

declare(strict_types=1);

// Walidacja inputów

function is_x_name_invalid(string $x_name) {
    if (strlen($x_name) >= 3 && strlen($x_name) <= 30 && preg_match('/^[A-Za-zęóąśłżźćńĘÓĄŚŁŻŹĆŃ]+$/', $x_name)) {
        return false;
    } else {
        return true;
    }
}

function is_email_invalid(string $email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else {
        return true;
    }
}

function is_username_invalid(string $username)
{
    if (strlen($username) >= 3 && strlen($username) <= 30) {
        return false;
    } else {
        return true;
    }
}

function is_password_invalid(string $pwd)
{
    if (strlen($pwd) >= 8 && strlen($pwd) <= 255) {
        return false;
    } else {
        return true;
    }
}

// Sprawdzanie, czy nazwa użytkownika oraz email są już zajęte

function is_email_unavailable(object $pdo, string $email)
{
    if (check_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function is_username_unavailable(object $pdo, string $username)
{
    if (check_username($pdo, $username)) {
        return true;
    } else {
        return false;
    }
}

// Filtrowanie danych przed dodaniem ich do bazy danych

function sanitize_email(string $email)
{
    return filter_var($email, FILTER_SANITIZE_EMAIL);
}

function sanitize_password(string $pwd) {
    $hashed_password = password_hash($pwd, PASSWORD_BCRYPT);
    
    return $hashed_password;
}

// Wysłanie token'a i danych rejestracji do bazy danych

function set_signup_handler(object $pdo, string $token, string $token_expiry, string $firstname, string $lastname, string $email, string $username, string $pwd) {
set_signup_data($pdo, $token, $token_expiry, $firstname, $lastname, $email, $username, $pwd);
}

// Dodanie użytkownika do bazy danych

function create_user(object $pdo, string $firstname, string $lastname, string $email, string $username, string $pwd) {
    set_user($pdo, $firstname, $lastname, $email, $username, $pwd);
}