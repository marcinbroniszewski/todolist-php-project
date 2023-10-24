<?php

declare(strict_types=1);

function user_content()
{
    if (isset($_SESSION['user_id'])) {
        try {
            require_once(realpath(dirname(__FILE__) . '/../includes/dbh.inc.php'));
            require_once(realpath(dirname(__FILE__) . '/../models/dashboard.model.php'));
            require_once(realpath(dirname(__FILE__) . '/../controllers/dashboard.contr.php'));

            $user_id = $_SESSION['user_id'];

            $todos = todo_list_handler($pdo, $user_id);

            $todos = array_reverse($todos);

            foreach ($todos as $todo) {
                $todoTitle = htmlspecialchars($todo['title']);
                $checkedAttribute = $todo['checked'] ? 'checked' : '';

                echo "<div id='" . $todo['id'] . "'>
                <input type='checkbox' class='todo-checkbox' data-todo-id='" . $todo['id'] . "' " . $checkedAttribute . ">
                <p class='todo-title'>" . $todoTitle . "</p>
                <button class='remove-todo-btn' data-todo-id='" . $todo['id'] . "'>Usuń todo</button>
                <button class='edit-todo-btn' data-todo-id='" . $todo['id'] . "'>Edytuj todo</button>
                </div>";
            }
        } catch (PDOException $e) {
            die("Wystąpił błąd: " . $e->getMessage());
        }
    } else {
        header("Location: /todolist-php-project/public/login.php");
    }
}
