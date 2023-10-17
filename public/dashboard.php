<?php

require_once(realpath(dirname(__FILE__) . '/../app/config/session.config.php'));
require_once(realpath(dirname(__FILE__) . '/../app/views/dashboard.view.php'));
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>dashboard</h1>
    <?php
    user_content();
    ?>
</body>
</html>