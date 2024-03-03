<?php

ini_set('session.use_only_cookies', 1);
ini_set('session.use_only_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 3600,
    'domain' => 'localhost',
    'path' => '/',
    'secure' => true,
    'httponly' => true
]);

session_start();

if (isset($_SESSION['user_id'])) {
    if (!isset($_SESSION['last_regeneration'])) {
        regenerate_session_id_loggedin();
    } else {
        $interval = 60 * 60;
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id_loggedin();
        };
    };
} else {
    if (!isset($_SESSION['last_regeneration'])) {
        regenerate_session_id();
    } else {
        $interval = 60 * 60;
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id();
        };
    };
}

function regenerate_session_id_loggedin()
{
    session_regenerate_id(true);

    $user_id = $_SESSION['user_id'];
    $new_session_id = session_create_id();
    $session_id = $new_session_id . "_" . $user_id;
    session_id($session_id);

    $_SESSION['last_regeneration'] = time();
}
function regenerate_session_id()
{
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();
}
