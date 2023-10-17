<?php

declare(strict_types=1);

// Walidacja inputów

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

function sanitize_username(string $username) {
    return htmlspecialchars($username);
}

function sanitize_password(string $pwd) {
    $hashed_password = password_hash($pwd, PASSWORD_BCRYPT);
    
    return $hashed_password;
}

// Dodanie użytkownika do bazy danych

function create_user(object $pdo, string $email, string $username, string $pwd) {
    signup_handler($pdo, $email, $username, $pwd);
}