<?php
require_once __DIR__ . '/../app/config/session.config.php';

if (empty($_SESSION['signup_success'])) {
    header("Location: index.php");
}

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
    <main class="d-flex flex-column justify-content-center align-items-center sign-section">
        <h1 class="sign-h1 mt-5 mb-3 px-4">Konto czeka na aktywację</h1>
        <p class="switch-paragraph mb-5">Sprawdź email i aktywuj konto.</p>
        <img class="token-error-img" src="img/dog.min.png" alt="pies w stroju astronauty">
    </main>
</body>
</html>