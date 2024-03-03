<?php

function login_inputs()
{
    echo '<label for="login-username" class="form-label">Nazwa użytkownika</label>
    <input type="text" class="form-control sign-input" name="username" id="login-username">';
    if (isset($_SESSION['login_errors']['username_error'])) {
        echo '<p class="error text-danger">' . $_SESSION['login_errors']['username_error'] . '</p>';
    }
    echo '<div><label for="login-password" class="form-label">Hasło</label>
    <input type="password" class="form-control sign-input" name="pwd" id="login-password">';
    if (isset($_SESSION['login_errors']['password_error'])) {
        echo '<p class="error text-danger">' . $_SESSION['login_errors']['password_error'] . '</p>';
    }

    echo '<a href="recover-password.php" class="recover-pwd-link">Odzyskaj hasło</a></div>';

    if(isset($_SESSION['login_errors'])){
        unset($_SESSION['login_errors']);
    }
}
