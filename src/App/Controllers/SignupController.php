<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class SignupController {

private TemplateEngine $view;

public function __construct() {
    $this->view = new TemplateEngine(Paths::VIEW);
}

public function signup() {
    echo $this->view->render('/signup.php', [
        'title' => 'Zarejestruj się',
        'css' => 'sign-form.min.css'
    ]);
}
}