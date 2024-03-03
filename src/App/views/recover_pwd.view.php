<?php

function recover_pwd_inputs()
{
    echo '<label for="email" class="form-label">Adres email</label>
    <input type="email" class="form-control sign-input" name="email" id="email">';
    if (isset($_SESSION['recover_pwd_errors']['email_error'])) {
        echo '<p class="error text-danger">' . $_SESSION['recover_pwd_errors']['email_error'] . '</p>';
    }

    if(isset($_SESSION['recover_pwd_errors'])){
        unset($_SESSION['recover_pwd_errors']);
    }
}


