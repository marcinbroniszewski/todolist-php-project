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

function check_token(object $pdo, string $token, string $table)
{
    $token_data = get_token_data($pdo, $token, $table);

    if ($token_data !== false) {
        return $token_data;
    } else {
        return [];
    }
}

function delete_token_handler(object $pdo, string $token, string $table) {
    delete_token_data($pdo, $token, $table);
}
