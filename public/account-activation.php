<?php

declare(strict_types=1);

$token = $_GET['token'] ?? null;

require_once __DIR__ . '/../app/views/account-activation.view.php';
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once(__DIR__ . '/../app/components/head_imports.php')
    ?>
    <link rel="stylesheet" href="./css/sign-form.min.css">
    <title>Document</title>
</head>
<body>
<?php
require_once(__DIR__ . '/../app/components/navigation_bar.php');
?>
<section class="d-flex flex-column justify-content-center align-items-center sign-section">
<?php
require_once __DIR__ . '/../app/views/account-activation.view.php';
account_activation_page_content();
?>

</section>
</body>
</html>