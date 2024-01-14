<?php
require_once(realpath(dirname(__FILE__) . '/../app/config/session.config.php'));
require_once(realpath(dirname(__FILE__) . '/../app/views/login.view.php'));
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
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
        <h1 class="sign-h1">Logowanie</h1>
        <form class="sign-form" action="../app/includes/login.inc.php" method="post">
        <?php
        login_inputs()
        ?>
            <div class="d-flex justify-content-end"><button type="submit" class="sign-btn btn btn-warning text-white">Zaloguj się</button></div>
        </form>
        <p class="switch-paragraph">Nie posiadasz konta? <a class="switch-link" href="signup.php">Zarejestruj się</a></p>
    </section>
    <script src="js/sign-inputs.min.js"></script>
</body>

</html>