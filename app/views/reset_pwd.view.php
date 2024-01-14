<?php

declare(strict_types=1);

require_once __DIR__ . '/../config/session.config.php';

$current_datetime = date("Y-m-d H:i:s", time());

require_once __DIR__ . '/../includes/reset_pwd_token_checker.inc.php';

function reset_pwd_form($token)
{

    $errors = $_SESSION['reset_pwd_errors'] ?? [];

    if (isset($errors['token_error'])) {
        echo <<<HTML
<h1 class="sign-h1 mt-4">$errors[token_error]</h1>
<p class="switch-paragraph px-5 mb-5">Kliknij <a class="switch-link" href="../public/recover-password.php">tutaj</a>, aby wysłać ponownie prośbę o zmiane hasła</p>
<img class="token-error-img" src="img/dog.min.png" alt="pies w stroju astronauty">
HTML;
    } else if (isset($errors['token_expiry_error'])) {
        echo <<<HTML
<h1 class="sign-h1 mt-4">$errors[token_expiry_error]</h1>
<p class="switch-paragraph px-5 mb-5">Kliknij <a class="switch-link" href="../public/recover-password.php">tutaj</a>, aby wysłać ponownie prośbę o zmiane hasła</p>
<img class="token-error-img" src="img/dog.min.png" alt="pies w stroju astronauty">
HTML;
    } else {
        $fixed_token = htmlspecialchars($token);
        echo <<<HTML
        <h1 class="sign-h1">Ustal nowe hasło</h1>
        <form class="sign-form" action="../app/includes/set_new_pwd.inc.php" method="post">
            <input type="hidden" value="$fixed_token" name="token">
            <label for="new-password" class="form-label">Nowe hasło</label>
            <input type="password" class="form-control sign-input" name="new-password">
    
    HTML;
    
    if (isset($errors['password_error'])) {
        echo '<p class="error text-danger">' . $errors['password_error'] . '</p>';
    }
    
    echo <<<HTML
            <label for="new-password-confirm" class="form-label">Potwierdź hasło</label>
            <input type="password" class="form-control sign-input" name="new-password-confirm">
    
    HTML;
    
    if (isset($errors['passwords_match_error'])) {
        echo '<p class="error text-danger">' . $errors['passwords_match_error'] . '</p>';
    }
    
    echo <<<HTML
            <div class="d-flex justify-content-end">
                <button type="submit" class="sign-btn btn btn-warning text-white">Zatwierdź nowe hasło</button>
            </div>
        </form>
    HTML;
    }

    if (isset($_SESSION['reset_pwd_errors'])) {
        unset($_SESSION['reset_pwd_errors']);
    }
}
