<?php
require_once(realpath(dirname(__FILE__) . '/../app/config/session.config.php'));
require_once(realpath(dirname(__FILE__) . '/../app/views/recover_pwd.view.php'));
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zmiana hasła</title>
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
        <h1 class="sign-h1">Zmień hasło</h1>
        <p class="px-3 text-center fs-4 text-secondary">Wystarczy, że podasz swój e-mail, a my pomożemy Ci ustawić nowe hasło.</p>
        <form class="sign-form" action="../app/includes/recover_password.inc.php" method="post">
            <?php
            recover_pwd_inputs()
            ?>
            <div class="d-flex justify-content-end"><button type="submit" class="sign-btn btn btn-warning text-white">Zmień hasło</button></div>
        </form>
    </section>

    <script src="js/sign-inputs.min.js"></script>
</body>

</html>