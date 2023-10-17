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
</head>

<body>
    <form action="../app/includes/login.inc.php" method="post">
        <?php
        login_inputs()
        ?>
        <button type="submit">Zaloguj się</button>
    </form>
</body>

</html>