<?php

function user_content($date)
{
    if (isset($_SESSION['user_id'])) {
        try {
            require_once(realpath(dirname(__FILE__) . '/../includes/dbh.inc.php'));
            require_once(realpath(dirname(__FILE__) . '/../models/dashboard.model.php'));
            require_once(realpath(dirname(__FILE__) . '/../controllers/dashboard.contr.php'));

            $user_id = $_SESSION['user_id'];
            $todos = todo_list_handler($pdo, $user_id, $date);
            $todos = array_reverse($todos);

            foreach ($todos as $todo) {
                $todo_title = htmlspecialchars($todo['title']);
                $todo_description = htmlspecialchars($todo['description']);
                $checked_attribute = $todo['checked'] ? 'checked' : '';

                echo "<div class='todo' id='" . $todo['id'] . "'>
                <input type='checkbox' class='todo-checkbox' data-todo-id='" . $todo['id'] . "' " . $checked_attribute . ">
                <p class='todo-title' data-todo-id='" . $todo['id'] . "'>" . $todo_title . "</p>
                <p class='todo-description' data-todo-id='" . $todo['id'] . "'>" . $todo_description . "</p>
                <button class='remove-todo-btn' data-todo-id='" . $todo['id'] . "'>Usuń todo</button>
                <button class='edit-todo-btn' data-bs-toggle='modal' data-bs-target='#editTodoModal' data-todo-id='" . $todo['id'] . "'>Edytuj todo</button>
                </div>";
            }
        } catch (PDOException $e) {
            die("Wystąpił błąd: " . $e->getMessage());
        }
    } else {
        header("Location: /todolist-php-project/public/login.php");
    }
}
