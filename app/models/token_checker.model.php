<?php

declare(strict_types=1);

function get_token_data(object $pdo, string $token, string $table)
{
    $query = "SELECT * FROM $table WHERE token = :token;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":token", $token);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function delete_token_data(object $pdo, string $token, string $table) {
    $query = "DELETE FROM $table WHERE token = :token;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":token", $token);
    $stmt->execute();
}