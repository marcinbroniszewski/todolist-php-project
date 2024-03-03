<?php

declare(strict_types=1);

function check_email(object $pdo, string $email)
{
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function check_for_token(object $pdo, string $email) {
    $query = "SELECT token FROM reset_pwd WHERE user_email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_reset_pwd_token(object $pdo, string $email, string $token, string $token_expiry)
{
    $query = "INSERT INTO reset_pwd (user_email, token, token_expiry) VALUES (
:email, :token, :token_expiry
    );";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':token', $token);
    $stmt->bindParam(':token_expiry', $token_expiry);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function update_pwd_token(object $pdo, string $email, string $token, string $token_expiry) {
    $query = "UPDATE reset_pwd SET token = :token, token_expiry = :token_expiry WHERE user_email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':token', $token);
    $stmt->bindParam(':token_expiry', $token_expiry);
    $stmt->execute();
}
