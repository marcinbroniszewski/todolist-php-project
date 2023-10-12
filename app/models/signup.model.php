<?php

declare(strict_types=1);

function signup_handler(object $pdo, string $email, string $username, string $pwd) {

    $solt = random_bytes(16);
    $salted_password = $solt . $pwd;

    $hashed_password = password_hash($salted_password, PASSWORD_BCRYPT);

    $query = "INSERT INTO users (username, pwd, email) VALUES (:username, :pwd, :email);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':pwd', $hashed_password);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
}

function check_email(object $pdo, string $email) {
 $query = "SELECT email FROM users WHERE email = :email;";
 $stmt = $pdo->prepare($query);
 $stmt->bindParam(':email', $email);
 $stmt->execute();
 $result = $stmt->fetch(PDO::FETCH_ASSOC);
 return $result;
}
function check_username(object $pdo, string $username) {
 $query = "SELECT username FROM users WHERE username = :username;";
 $stmt = $pdo->prepare($query);
 $stmt->bindParam(':username', $username);
 $stmt->execute();
 $result = $stmt->fetch(PDO::FETCH_ASSOC);
 return $result;
}
