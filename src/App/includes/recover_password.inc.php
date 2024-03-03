<?php

declare(strict_types=1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    if (empty($email)) {
        require_once(realpath(dirname(__FILE__) . '/../config/session.config.php'));
        $_SESSION['recover_pwd_errors']['email_error'] = 'Podaj email';

        header("Location: ../../public/recover-password.php");
        die();
    }

    try {
        require_once(realpath(dirname(__FILE__) . '/dbh.inc.php'));
        require_once(realpath(dirname(__FILE__) . '/../models/recover_password.model.php'));
        require_once(realpath(dirname(__FILE__) . '/../controllers/recover_password.contr.php'));
        require_once(realpath(dirname(__FILE__) . '/../config/session.config.php'));

        $errors = [];


        if (is_email_incorrect($email)) {
            $errors['email_error'] = 'Podany format email jest niewłaściwy.';
        }

        if (is_email_doesnt_exist($pdo, $email)) {
            $errors['email_error'] = 'Użytkownik o podanym emailu nie istnieje';
        }

        if ($errors) {

            $_SESSION['recover_pwd_errors'] = $errors;

            header("Location: ../../public/recover-password.php");
            die();
        } else {
            $token = bin2hex(random_bytes(16));
            $token_hash = hash("sha256", $token);
            $expiry = date("Y-m-d H:i:s", time() + 60 * 30);


            if (is_token_exist($pdo, $email)) {
                replace_token($pdo, $email, $token_hash, $expiry);
            } else {
                send_pwd_token($pdo, $email, $token_hash, $expiry);
            }

            $mail = require __DIR__ . "/mailer.inc.php";

            $mail->addAddress($email);
            $mail->Subject = mb_encode_mimeheader("Reset hasła", "UTF-8");
            $mail->Body = <<<END
                Kliknij <a href="http://localhost:3000/todolist-php-project/public/reset-password.php?token=$token">tutaj</a>, aby zresetować hasło.
                END;

            try {
                $mail->send();

                $_SESSION['recover_pwd_request_sent'] = true;
                header("Location: ../../public/recover-password-info.php");
                exit();

            } catch (Exception $e) {
                echo "Wiadomość nie mogła zostać wysłana. Błąd {$mail->ErrorInfo}";
            }
        }
    } catch (PDOException $e) {
        die("Wystąpił błąd: " . $e->getMessage());
    }
}
