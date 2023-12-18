<?php

require_once(realpath(dirname(__FILE__) . '/../app/config/session.config.php'));
require_once(realpath(dirname(__FILE__) . '/../app/views/dashboard.view.php'));
require_once(realpath(dirname(__FILE__) . '/../app/views/calendar.view.php'));
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

    <main class="p-4">
        <?php
        $username = $_SESSION['user_username'];
        echo "<h1 class='welcome-header py-2 text-light-gray'>Witaj, $username!</h1>";
        ?>

        <div class="d-flex mb-2">
        <p><span class="task-counter bigger-text"></span><img class="calendar-icon align-top ms-3" src="./img/calendar-icon.min.png" alt="calendar icon"></p>
        </div>

        <div class="d-md-flex flex-row-reverse justify-content-between">
            <section class="calendar mb-5 d-flex justify-content-center align-items-center">
                <div>
                    <div class="month-year-box d-flex justify-content-between align-items-center mb-4">
                        <h2 class="month-year px-3"></h2>
                        <button class="btn btn-dark add-todo-panel-btn" data-bs-toggle="modal" data-bs-target="#addTodoModal"><i class="fa-solid fa-plus fa-xs" style="color: #ffffff;"></i> Dodaj zadanie</button>
                    </div>
                    <div>
                        <table class="calendar-table">
                            <thead class="week-days">
                                <tr>
                                    <th class="week-day">Pon</th>
                                    <th class="week-day">Wt</th>
                                    <th class="week-day">Śr</th>
                                    <th class="week-day">Czw</th>
                                    <th class="week-day">Pt</th>
                                    <th class="week-day">Sob</th>
                                    <th class="week-day">Niedz</th>
                                </tr>
                            </thead>
                            <tbody class="numeric-days">
                                <!-- <?php

                                if (isset($_SESSION['date'])) {

                                    $date = $_SESSION['date'];
                                    list($year, $month, $day) = explode("-", $date);

                                    create_calendar($year, $month, $day);
                                } else {
                                    $year = date('Y');
                                    $month = date('m');
                                    $day = date('d');
                                    create_calendar($year, $month, $day);
                                }              
                                ?> -->
                            </tbody>
                        </table>
                    </div>
                    <div class="month-btns-box d-flex justify-content-between my-4 px-4">
                        <button class="prev-month-btn btn switch-month-btn"><i class="fa-solid fa-chevron-left fa-2xl" style="color: #ffffff;"></i></button>
                        <button class="next-month-btn btn switch-month-btn"><i class="fa-solid fa-chevron-right fa-2xl" style="color: #ffffff;"></i></button>
                    </div>
                </div>
            </section>
            <section class="todo-list">
                <h2 class="bigger-text">Moje zadania</h2>
                <div class="todos-box d-flex flex-column justify-content-center align-items-center">
                    <?php
                    if (isset($_SESSION['date'])) {
                        $date = $_SESSION['date'];
                        user_content($date);
                    } else {
                        $currentDate = date("Y-m-d");
                        $_SESSION['date'] = $currentDate;
                        user_content($currentDate);
                    }
                    ?>
                </div>
            </section>
        </div>

    </main>


    <div class="modal fade" id="addTodoModal" tabindex="-1" aria-labelledby="addTodoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addTodoModalLabel">Dodaj nowe zadanie</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form action="../app/includes/add_todo.inc.php" method='post' id='todo-form' autocomplete="off">
                        <div class="mb-3">
                            <input type="text" class="form-control add-todo-title" placeholder="Podaj tytuł zadania" name='todo-title'>
                            <p class="error-text d-none text-danger">Tytuł zadania nie może być pusty.</p>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control add-todo-description" placeholder="Zmień opis zadania" id="floatingTextarea" name="todo-description"></textarea>
                            <label for="floatingTextarea" class="text-secondary">Podaj opis zadania (opcjonalnie)</label>
                        </div>

                        <div class="mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuluj</button>
                            <button type="submit" class="btn btn-warning text-white add-todo-btn">Zatwierdź</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editTodoModal" tabindex="-1" aria-labelledby="editTodoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editTodoModalLabel">Edytuj zadanie</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <section class="edit-todo-panel">
                        <div class="mb-3">
                            <input type="text" placeholder="Podaj nową nazwę zadania" class="edit-todo-input form-control">
                            <p class="error-text d-none text-danger">Nazwa zadania nie może być pusta.</p>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control edit-todo-description" placeholder="Podaj opis zadania (opcjonalnie)" id="floatingTextarea" name="edit-todo-description"></textarea>
                            <label for="floatingTextarea" class="text-secondary">Zmień opis zadania lub go usuń</label>
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

    <script src="js/bootstrap.min.js"></script>
    <script src="js/todolist.min.js"></script>
    <script src="js/calendar.min.js"></script>

</body>

</html>