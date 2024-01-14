<?php

declare(strict_types=1);

function get_token_data(object $pdo, string $token)
{
    $query = "SELECT * FROM reset_pwd WHERE token = :token;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":token", $token);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function update_password(object $pdo, string $email, string $pwd) {
    $query = "UPDATE users SET pwd = :pwd WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":pwd", $pwd);
    $stmt->execute();
}

function check_password(object $pdo, string $id) {
    $query = "SELECT pwd FROM users WHERE id = :id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['pwd'];
}