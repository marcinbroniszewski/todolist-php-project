<?php
require_once(realpath(dirname(__FILE__) . '/../app/config/session.config.php'));
require_once(realpath(dirname(__FILE__) . '/../app/views/signup.view.php'));
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <?php
    require_once(__DIR__ . '/../app/components/head_imports.php')
    ?>
    <link rel="stylesheet" href="./css/sign-form.min.css">
</head>

<body>
    <?php
    require_once(__DIR__ . '/../app/components/navigation_bar.php')
    ?>

    <section class="d-flex flex-column justify-content-center align-items-center sign-section">
        <h1 class="sign-h1">Rejestracja</h1>
        <form class="sign-form" action="../app/includes/signup.inc.php" method="post">
            <?php signup_inputs() ?>
            <button type="submit" class="sign-btn btn btn-warning text-white">Zarejestruj się</button>
        </form>
        <p class="switch-paragraph">Posiadasz już konto? <a class="switch-link" href="login.php">Zaloguj się</a></p>
    </section>

    <script src="js/signup.min.js"></script>
</body>

</html>