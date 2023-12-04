<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todo Lista</title>
  <?php
  require_once(__DIR__ . '/../app/components/head_imports.php')
  ?>
  <link rel="stylesheet" href="./css/home.min.css">
</head>

<body>
  <?php
  require_once(__DIR__ . '/../app/components/navigation_bar.php')
  ?>

  <main>
    <section class="d-flex flex-column justify-content-center align-items-center home-section pt-sm-5">
      <div class="home-text-box d-flex flex-column justify-content-center align-items-center text-center mt-md-5 px-5">
        <h1 class="home-h1 mb-sm-3">
          Planuj każdy dzień. Efektywnie wykorzystuj czas, aby osiągnąć sukces.
        </h1>
        <p class="home-subtext px-sm-5 pb-3 mb-5">Dzięki todo liście lepiej zorganizujesz czas zwiększając szanse na osiągnięcie celów.
          Osiągnij spokój i kontrolę planując swój tydzień już teraz.
        </p>
        <a class="signup-btn" href="signup.php">
          Zacznij za darmo
        </a>
      </div>
      <picture>
        <source media="(max-width: 600px)" srcset="./img/notes-small.png">
        <source media="(min-width: 601px)" srcset="./img/notes-big.png">
        <img class="todolist-img" src="./img/notes-big.png" alt="Opis obrazu">
      </picture>
    </section>
  </main>
</body>

</html>