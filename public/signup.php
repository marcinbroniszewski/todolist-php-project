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
</head>

<body>
<?php 
require_once(__DIR__ . '/../app/components/navigation_bar.php')
?>
    <form action="../app/includes/signup.inc.php" method="post">

        <?php signup_inputs() ?>

        <button type="submit">Zarejestruj się</button>
    </form>

    <script src="js/signup.min.js"></script>
</body>

</html>