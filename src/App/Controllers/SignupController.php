<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;

class SignupController
{

    public function __construct(private TemplateEngine $view)
    {
    }

    public function signup()
    {
        echo $this->view->render('/signup.php', [
            'title' => 'Zarejestruj się',
            'css' => 'sign-form.min.css'
        ]);
    }
}
