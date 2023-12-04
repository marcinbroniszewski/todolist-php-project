<?php

function login_inputs()
{
    echo '<label for="login-username" class="form-label">Nazwa użytkownika</label>
    <input type="text" class="form-control" name="username" id="login-username">';
    if (isset($_SESSION['login_errors']['username_error'])) {
        echo '<p class="error text-danger">' . $_SESSION['login_errors']['username_error'] . '</p>';
    }
    echo '<label for="login-password" class="form-label">Hasło</label>
    <input type="password" class="form-control" name="pwd" id="login-password">';
    if (isset($_SESSION['login_errors']['password_error'])) {
        echo '<p class="error text-danger">' . $_SESSION['login_errors']['password_error'] . '</p>';
    }

    if(isset($_SESSION['login_errors'])){
        unset($_SESSION['login_errors']);
    }
}
