<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/../../vendor/autoload.php";
$envFilePath = __DIR__ . '/../../.env';

$dotenv = Dotenv\Dotenv::createImmutable(dirname($envFilePath));
$dotenv->load();

$mail = new PHPMailer(true);

$username = $_ENV['RESET_PWD_USERNAME'];
$password = $_ENV['RESET_PWD_PASSWORD'];

  $mail->isSMTP();                    
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = $username;              
  $mail->Password = $password;  
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   
  $mail->Port = 465; 
  $mail->setFrom($username);
  $mail->SMTPDebug = SMTP::DEBUG_SERVER;

  $mail->isHtml(true);

  return $mail;

