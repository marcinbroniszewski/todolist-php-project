<?php

function login_inputs()
{
    echo '<input type="text" name="username" placeholder="Nazwa użytkownika">';
    if (isset($_SESSION['login_errors']['username_error'])) {
        echo '<p class="error">' . $_SESSION['login_errors']['username_error'] . '</p>';
    }
    echo '<input type="password" name="pwd" placeholder="Hasło">';
    if (isset($_SESSION['login_errors']['password_error'])) {
        echo '<p class="error">' . $_SESSION['login_errors']['password_error'] . '</p>';
    }

    if(isset($_SESSION['login_errors'])){
        unset($_SESSION['login_errors']);
    }
}
