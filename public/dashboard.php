<?php

require_once(realpath(dirname(__FILE__) . '/../app/config/session.config.php'));
require_once(realpath(dirname(__FILE__) . '/../app/views/dashboard.view.php'));
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Dashboard</title>
</head>

<body>
    <h1>dashboard</h1>
    <form action="../app/includes/add_todo.inc.php" method='post' id='todo-form' autocomplete="off">

        <input type="text" placeholder="podaj nazwę zadania" name='todo'>

        <button type="submit">Dodaj zadanie</button>
    </form>

    <section class="todo-list">
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

    <section class="edit-todo-panel">
        <div>
            <input type="text" placeholder="Podaj nową nazwę zadania" class="edit-todo-input">
            <button class="save-changes">
                Zatwierdź
            </button>
        </div>
        <button class="close-todo-panel">Anuluj</button>
    </section>

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

    <script src="js/todolist.js"></script>
<script src="js/calendar.js"></script>

</body>

</html>