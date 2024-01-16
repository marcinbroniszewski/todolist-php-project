<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/../../vendor/autoload.php";
$envFilePath = __DIR__ . '/../../.env';

$dotenv = Dotenv\Dotenv::createImmutable(dirname($envFilePath));
$dotenv->load();

$mail = new PHPMailer(true);

$username = $_ENV['USERNAME'];
$password = $_ENV['PASSWORD'];

  $mail->isSMTP();                    
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = $username;              
  $mail->Password = $password;  
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   
  $mail->Port = 465; 
  $mail->setFrom($username);

  $mail->isHtml(true);

  return $mail;

