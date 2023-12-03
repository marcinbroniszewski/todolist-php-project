<?php 

echo <<<'HTML'
<nav class="navbar navbar-expand-lg bg-body-tertiary">
<div class="navbar-container d-flex justify-content-around justify-content-lg-between">
  <a class="navbar-brand navbar-logo fs-1" href="/todolist-php-project/public"><i class="fa-regular fa-note-sticky"></i> PHPTodoList</a>
  <div class="navbar-nav fs-2">
    <a class="nav-link" href="login.php">Zaloguj się</a>
    <a class="nav-link d-none d-md-block ms-4 signup-btn" href="signup.php">Zacznij za darmo</a>
  </div>
</div>
</nav>

HTML;
?>