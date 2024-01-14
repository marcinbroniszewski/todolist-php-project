<?php

declare(strict_types=1);

function is_email_incorrect(string $email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    } else {
        return true;
    }
}
function is_email_doesnt_exist(object $pdo, string $email)
{
    if (check_email($pdo, $email)) {
        return false;
    } else {
        return true;
    }
}

function send_pwd_token(object $pdo, string $email, string $token, string $token_expiry)
{
    set_reset_pwd_token($pdo, $email, $token, $token_expiry);
}

function is_token_exist(object $pdo, string $email)
{
    if (check_for_token($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function replace_token(object $pdo, string $email, string $token, string $token_expiry) {
    update_pwd_token($pdo, $email, $token, $token_expiry);
}