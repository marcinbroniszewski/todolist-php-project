<?php

$autoloadPath = __DIR__ . '/../../vendor/autoload.php';
require $autoloadPath;

$envFilePath = __DIR__ . '/../../.env';

$dotenv = Dotenv\Dotenv::createImmutable(dirname($envFilePath));
$dotenv->load();

$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$dbusername = $_ENV['DB_USER'];
$dbpassword = $_ENV['DB_PASS'];

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
