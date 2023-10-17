<?php
declare(strict_types=1);
    
function user_content() {
    if (isset($_SESSION['user_id'])) {
        echo 'działa';
    } else {
        header("Location: /todolist-php-project/public/login.php");
    }
}

