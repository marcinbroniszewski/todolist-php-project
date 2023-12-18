<?php

declare(strict_types=1);

function user_content(string $date)
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
                $done_class = $todo['checked'] ? 'todo-done' : '';

                echo <<<HTML
                 <div class='todo shadow rounded $done_class' id='{$todo['id']}'>
                     <div class="checkbox-wrapper-4">
                         <input class="inp-cbx todo-checkbox" id="morning_{$todo['id']}" type="checkbox" data-todo-id='{$todo['id']}' {$checked_attribute}/>
                         <label class="cbx" for="morning_{$todo['id']}"><span>
                             <svg width="12px" height="10px">
                                 <use xlink:href="#check-4"></use>
                             </svg></span></label>
                         <svg class="inline-svg">
                             <symbol id="check-4" viewbox="0 0 12 10">
                                 <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                             </symbol>
                         </svg>
                     </div>
                     <div class="todo-text-box">
                         <p class='todo-title' data-todo-id='{$todo['id']}'>{$todo_title}</p>
                         <p class='todo-description text-light-gray' data-todo-id='{$todo['id']}'>{$todo_description}</p>
                     </div>
                     <div class="d-flex">
                         <button class='remove-todo-btn btn btn-secondary me-2 text-light' data-todo-id='{$todo['id']}'><i class="fa-regular fa-trash-can fa-xl" style="color: #ffffff;"></i></button>
                         <button class='edit-todo-btn btn btn-warning text-light' data-bs-toggle='modal' data-bs-target='#editTodoModal' data-todo-id='{$todo['id']}'><i class="fa-regular fa-pen-to-square fa-xl" style="color: #ffffff;"></i></button>
                     </div>
                 </div>
            HTML;
            }
        } catch (PDOException $e) {
            die("Wystąpił błąd: " . $e->getMessage());
        }
    } else {
        header("Location: /todolist-php-project/public/login.php");
    }
}
