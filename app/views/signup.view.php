<?php

function signup_inputs()
{

    echo '<label for="signup-email" class="form-label">Adres email</label>
    <input type="email" class="form-control" name="email" id="signup-email">';

    if (isset($_SESSION['signup_errors']['email_error'])) {
        echo '<p class="error text-danger">' . $_SESSION['signup_errors']['email_error'] . '</p>';
    }
    echo '<label for="signup-username" class="form-label">Nazwa użytkownika</label>
<input type="text" class="form-control"  name="username" id="signup-username">';

    if (isset($_SESSION['signup_errors']['username_error'])) {
        echo '<p class="error text-danger">' . $_SESSION['signup_errors']['username_error'] . '</p>';
    }
    echo '<label for="signup-password" class="form-label">Hasło</label>
<input type="password" class="form-control"  name="pwd" id="signup-password">';

    if (isset($_SESSION['signup_errors']['password_error'])) {
        echo '<p class="error text-danger">' . $_SESSION['signup_errors']['password_error'] . '</p>';
    }

    if (isset($_SESSION['signup_errors'])) {
        unset($_SESSION['signup_errors']);
    }
}
