<?php

declare(strict_types=1);

function profile_img_url(object $pdo)
{
        if (isset($_SESSION['user_id'])) {
                require_once(realpath(dirname(__FILE__) . '/../models/dashboard.model.php'));
                require_once(realpath(dirname(__FILE__) . '/../controllers/dashboard.contr.php'));

                $user_id = $_SESSION['user_id'];
                $profile_img = profile_img_handler($pdo, $user_id);

                if ($profile_img) {
                        echo $profile_img['profile_img'];
                } else {
                        $default_img_path = "../uploads/default-profile.svg";
                        echo $default_img_path;
                }
        } else {
                header("Location: /todolist-php-project/public/login.php");
        }
}
