<?php

require_once(realpath(dirname(__FILE__) . '/../app/config/session.config.php'));
require_once(realpath(dirname(__FILE__) . '/../app/views/dashboard.view.php'));
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://kit.fontawesome.com/d4493cf6c8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard.min.css">
</head>

<body>

    <main class="p-2">
        <?php
        $username = $_SESSION['user_username'];
        echo "<h1>Witaj, $username!</h1>";
        ?>

        <div class="d-flex">
            <p class="task-counter"></p><span><img class="calendar-icon" src="./img/calendar-icon.min.png" alt="calendar icon"></span>
        </div>

        <section class="calendar">
            <h2 class="month-year"></h2>
            <table class="calendar-table">
                <thead class="week-days">
                    <tr>
                        <th>Pon</th>
                        <th>Wt</th>
                        <th>Śr</th>
                        <th>Czw</th>
                        <th>Pt</th>
                        <th>Sob</th>
                        <th>Niedz</th>
                    </tr>
                </thead>
                <tbody class="numeric-days">
                </tbody>
            </table>
            <button class="prev-month-btn">
                < </button>
                    <button class="next-month-btn">></button>
        </section>


        <section class="todo-list">
            <h2>Moje zadania</h2>



            <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addTodoModal"><i class="fa-solid fa-plus fa-xs" style="color: #ffffff;"></i> Dodaj zadanie</button>


            <div class="modal fade" id="addTodoModal" tabindex="-1" aria-labelledby="addTodoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addTodoModalLabel">Dodaj nowe zadanie</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="../app/includes/add_todo.inc.php" method='post' id='todo-form' autocomplete="off">
                                <input type="text" class="form-control mb-3" placeholder="Podaj tytuł zadania" name='todo-title'>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Zmień opis zadania" id="floatingTextarea" name="todo-description"></textarea>
                                    <label for="floatingTextarea" class="text-secondary">Podaj opis zadania (opcjonalnie)</label>
                                </div>

                                <div class="mt-3">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                                    <button type="submit" class="btn btn-warning text-white">Zatwierdź</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php

            if (isset($_SESSION['date'])) {
                $date = $_SESSION['date'];
                user_content($date);
                unset($_SESSION['date']);
            } else {
                $currentDate = date("Y-m-d");
                user_content($currentDate);
            }
            ?>
        </section>



        <div class="modal fade" id="editTodoModal" tabindex="-1" aria-labelledby="editTodoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editTodoModalLabel">Edytuj zadanie</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <section class="edit-todo-panel">
                            <div class="mb-3">
                                <input type="text" placeholder="Podaj nową nazwę zadania" class="edit-todo-input form-control">
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control edit-todo-description" placeholder="Podaj opis zadania (opcjonalnie)" id="floatingTextarea" name="edit-todo-description"></textarea>
                                <label for="floatingTextarea" class="text-secondary">Zmień opis zadania</label>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                                <button class="save-changes btn btn-warning text-white">
                                    Zatwierdź
                                </button>
                            </div>
                        </section>

                    </div>
                </div>
            </div>
        </div>



    </main>


    <script src="js/bootstrap.min.js"></script>
    <script src="js/todolist.min.js"></script>
    <script src="js/calendar.min.js"></script>

</body>

</html>