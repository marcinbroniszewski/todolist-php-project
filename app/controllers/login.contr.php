<?php

declare(strict_types=1);

function is_username_incorrect(bool | array $user_data)
{

    if (!$user_data) {
        return true;
    } else {
        return false;
    }
}


function is_password_incorrect(string $pwd, bool | array $user_data)
{
    if ($user_data) {
        $hashed_password = $user_data['pwd'];

        if (!password_verify($pwd, $hashed_password)) {
            return true;
        } else {
            return false;
        }
    }
}

function login_user(array $user_data) {
    if($user_data) {
        return $user_data['id'];
    }
}
