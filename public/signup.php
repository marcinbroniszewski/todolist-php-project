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
            <div class="d-flex justify-content-end"><button type="submit" class="sign-btn btn btn-warning text-white">Zarejestruj się</button></div>
        </form>
        <p class="switch-paragraph">Posiadasz już konto? <a class="switch-link" href="login.php">Zaloguj się</a></p>
        <div class="info mt-5 text-danger fs-2 border border-danger"><p>Uwaga! Adres email musi być prawdziwy, ponieważ zostanie na niego wysłany link aktywacyjny.    
        </p></div>
    </section>

    <script src="js/sign-inputs.min.js"></script>
</body>

</html>