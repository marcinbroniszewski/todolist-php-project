<?php

function signup_inputs() {

    echo '<input type="email" name="email" placeholder="Podaj adres email" id="signup-email">';

    if(isset($_SESSION['signup_errors']['email_error'])) {
        echo '<p class="error">' . $_SESSION['signup_errors']['email_error'] . '</p>';
    }
echo '<input type="text" name="username" placeholder="Podaj nazwę użytkownika" id="signup-username">';

if(isset($_SESSION['signup_errors']['username_error'])) {
    echo '<p class="error">' . $_SESSION['signup_errors']['username_error'] . '</p>';
}
echo '<input type="password" name="pwd" placeholder="Podaj hasło" id="signup-password">';

if(isset($_SESSION['signup_errors']['password_error'])) {
    echo '<p class="error">' . $_SESSION['signup_errors']['password_error'] . '</p>';
}

if(isset($_SESSION['signup_errors'])){
    unset($_SESSION['signup_errors']);
}
}