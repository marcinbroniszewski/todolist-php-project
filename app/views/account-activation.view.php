<?php

require_once __DIR__ . '/../config/session.config.php';

$current_datetime = date("Y-m-d H:i:s", time());

require_once __DIR__ . '/../includes/signup_token_checker.inc.php';

function account_activation_page_content() {
    $errors = $_SESSION['token_signup_errors'] ?? [];

    if (isset($errors['token_error'])) {
        echo <<<HTML
<h1 class="sign-h1 mt-4">$errors[token_error]</h1>
<p class="switch-paragraph px-5 mb-5">Kliknij <a class="switch-link" href="../public/signup.php">tutaj</a>, ponownie się zarejestrować</p>
<img class="token-error-img" src="img/dog.min.png" alt="pies w stroju astronauty">
HTML;
    } else if (isset($errors['token_expiry_error'])) {
        echo <<<HTML
<h1 class="sign-h1 mt-4">$errors[token_expiry_error]</h1>
<p class="switch-paragraph px-5 mb-5">Kliknij <a class="switch-link" href="../public/signup.php">tutaj</a>, ponownie się zarejestrować</p>
<img class="token-error-img" src="img/dog.min.png" alt="pies w stroju astronauty">
HTML;
    } else {
        echo <<<HTML
        <h1 class="sign-h1 mt-4">Twoje konto zostało aktywowane</h1>
        <p class="switch-paragraph px-5 mb-5">Kliknij <a class="switch-link" href="../public/login.php">tutaj</a>, aby się zalogować</p>
        <img class="token-error-img" src="img/dog.min.png" alt="pies w stroju astronauty">
        HTML;
    }

    if (isset($_SESSION['token_signup_errors'])) {
        unset($_SESSION['token_signup_errors']);
    }
}