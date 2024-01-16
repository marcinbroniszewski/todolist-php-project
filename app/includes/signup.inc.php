<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    try {
        require_once(realpath(dirname(__FILE__) . '/dbh.inc.php'));
        require_once(realpath(dirname(__FILE__) . '/../models/signup.model.php'));
        require_once(realpath(dirname(__FILE__) . '/../controllers/signup.contr.php'));
        require_once(realpath(dirname(__FILE__) . '/../config/session.config.php'));

        $errors = [];

        if (is_x_name_invalid($first_name)) {
            $errors['firstname_error'] = 'Podaj prawidłowe imię, od 3 do 30 liter';
        }
        if (is_x_name_invalid($last_name)) {
            $errors['lastname_error'] = 'Podaj prawidłowe nazwisko, od 3 do 30 liter';
        }

        if (is_email_invalid($email)) {
            $errors['email_error'] = 'Podany email jest nieprawidłowy';
        }
        if (is_username_invalid($username)) {
            $errors['username_error'] = 'Nazwa użytkownika musi składać się od 3 do 30 znaków';
        }
        if (is_password_invalid($pwd)) {
            $errors['password_error'] = 'Hasło musi składać się z co najmniej 8 znaków';
        }
        if (is_email_unavailable($pdo, $email)) {
            $errors['email_error'] = 'Wybrany email jest już zajęty';
        }
        if (is_username_unavailable($pdo, $username)) {
            $errors['username_error'] = 'Użytkownik o danej nazwie już istnieje';
        }

        if ($errors) {

            $_SESSION['signup_errors'] = $errors;

            header("Location: ../../public/signup.php");
            die();
        } else {
            $token = bin2hex(random_bytes(16));
            $token_hash = hash("sha256", $token);
            $token_expiry = date("Y-m-d H:i:s", time() + 60 * 30);

            $firstname_fixed = ucfirst($first_name);
            $lastname_fixed = ucfirst($last_name);

            $sanitizedEmail = sanitize_email($email);
            $sanitizedPassword = sanitize_password($pwd);

            $mail = require __DIR__ . "/mailer.inc.php";

            $mail->addAddress($email);
            $mail->Subject = mb_encode_mimeheader("Rejestracja konta", "UTF-8");
            $mail->Body = <<<END
                Kliknij <a href="http://localhost:3000/todolist-php-project/public/account-activation.php?token=$token">tutaj</a>, aby aktywować konto.
                END;

             try {
                    if ($mail->send() === true) {
                        set_signup_handler($pdo, $token_hash, $token_expiry, $firstname_fixed, $lastname_fixed, $sanitizedEmail, $username, $sanitizedPassword);
                        $_SESSION['signup_success'] = true;
                        header("Location: ../../public/signup-info.php");
                        exit();
                    } else {
                        echo "
                        <script>
                        alert('Wiadomość nie mogła zostać wysłana na podany email')
                        window.location.href = '../../public/signup.php';
                            </script>
                            ";
                        exit();
                    }
    
                } catch (Exception $e) {
                    echo "Wiadomość nie mogła zostać wysłana. Błąd {$mail->ErrorInfo}";
                }

        }
    } catch (PDOException $e) {
        die("Wystąpił błąd: " . $e->getMessage());
    }
} else {
    header("Location: ../../public/signup.php");
    die();
}
