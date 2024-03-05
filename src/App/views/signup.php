<?php
include $this->resolve("components/_head.php");

head($title, $css);
?>

<body>

<?php
include $this->resolve("components/_navigation.php");
?>
    
        <section class="d-flex flex-column justify-content-center align-items-center sign-section">
            <h1 class="sign-h1">Rejestracja</h1>
            <form class="sign-form" action="../app/includes/signup.inc.php" method="post">
                
                <div class="d-flex justify-content-end"><button type="submit" class="sign-btn btn btn-warning text-white">Zarejestruj się</button></div>
            </form>
            <p class="switch-paragraph">Posiadasz już konto? <a class="switch-link" href="login.php">Zaloguj się</a></p>
            <div class="info mt-5 text-danger fs-2 border border-danger"><p>Uwaga! Adres email musi być prawdziwy, ponieważ zostanie na niego wysłany link aktywacyjny.    
            </p></div>
        </section>
    
        <script src="js/sign-inputs.min.js"></script>
    </body>
    
    </html>

