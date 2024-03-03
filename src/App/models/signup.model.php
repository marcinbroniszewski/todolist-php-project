<?php

declare(strict_types=1);

function set_signup_data(object $pdo, string $token, string $token_expiry, string $firstname, string $lastname, string $email, string $username, string $pwd) {
    $query = "INSERT INTO signup_users (token, token_expiry, firstname, lastname, email, username, pwd) VALUES (:token, :token_expiry, :firstname, :lastname, :email, :username, :pwd);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':token', $token);
    $stmt->bindParam(':token_expiry', $token_expiry);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':pwd', $pwd);
    $stmt->execute();
}

function set_user(object $pdo, string $firstname, string $lastname, string $email, string $username, string $pwd) {
    $query = "INSERT INTO users (firstname, lastname, email, username, pwd) VALUES (:firstname, :lastname, :email, :username, :pwd);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':pwd', $pwd);
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
