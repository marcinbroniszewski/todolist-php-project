<?php

require_once(realpath(dirname(__FILE__) . '/../app/includes/dbh.inc.php'));
require_once(realpath(dirname(__FILE__) . '/../app/config/session.config.php'));
require_once(realpath(dirname(__FILE__) . '/../app/views/dashboard.view.php'));
require_once(realpath(dirname(__FILE__) . '/../app/views/profile_img.view.php'));
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

    <main class="main-section d-flex position-relative bg-white">

        <div class="dashboard-nav-container">
            <button class="dashboard-nav-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <div class="back-shadow"></div>
            <div class="dashboard-nav-box">
                <span class="d-none d-md-block logo-icon"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-stickies-fill" viewBox="0 0 16 16">
                        <path d="M0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1H1.5A1.5 1.5 0 0 0 0 1.5" />
                        <path d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2zm6 8.5a1 1 0 0 1 1-1h4.396a.25.25 0 0 1 .177.427l-5.146 5.146a.25.25 0 0 1-.427-.177z" />
                    </svg></span>
                <ul class="dashboard-nav">
                    <li class="active"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid-fill" viewBox="0 0 16 16">
                            <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5z" />
                        </svg><span>Panel</span></li>
                    <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                            <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                        </svg><span>Ustawienia</span></li>
                    <li>
                        <i class="fa-solid fa-door-open fa-lg" style="color: #080808;"></i>
                        <span>Wyloguj</span>
                    </li>
                </ul>
            </div>
        </div>


        <div class="w-100 p-4 p-sm-5 position-relative mt-lg-5 ms-xl-5">
            <div class="greet-container">
                <?php
                $username = $_SESSION['user_username'];
                echo "<h1 class='welcome-header mt-5 py-3 text-light-gray'>Witaj, $username!</h1>";
                ?>
                <div class="profile-box"><span><img src="<?php profile_img_url($pdo); ?>" alt="profile icon" class="profile-icon"></span>
                    <?php echo "<span class='profile-name'>$username</span>"; ?>
                </div>
                <div class="d-flex mb-3">
                    <p><span class="task-counter bigger-text"></span><img class="calendar-icon align-top ms-3" src="./img/calendar-icon.min.png" alt="calendar icon"></p>
                </div>
            </div>

            <div class="main-container">

                <section class="calendar mb-5 d-flex justify-content-center align-items-start">
                    <div>
                        <div class="month-year-box d-flex justify-content-between align-items-top">
                            <div class="me-1">
                                <h2 class="month-year"></h2>
                                <p class="day-date bigger-text"></p>
                            </div>
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
                    <div class="search-box mb-5 d-none">
                        <i class="fa-solid fa-magnifying-glass fa-xl" style="color: #a8a8a8;"></i>
                        <input type="text" class="search-input" placeholder="Wyszukaj todo...">
                    </div>
                    <h2 class="my-tasks-header bigger-text d-none">Moje zadania</h2>
                    <div class="todo-list-wrapper">
                        <div class="todos-box">
                            <?php
                            if (isset($_SESSION['date'])) {
                                $date = $_SESSION['date'];
                                user_content($pdo, $date);
                            } else {
                                $currentDate = date("Y-m-d");
                                $_SESSION['date'] = $currentDate;
                                user_content($pdo, $currentDate);
                            }
                            ?>
                        </div>
                    </div>
                    </section>
                </div>
            <!-- <form action="../app/includes/upload_image.inc.php" method="post" enctype="multipart/form-data">
                <label for="image">Wybierz obrazek:</label>
                <input type="file" name="image" id="image" accept="image/*">
                <br>
                <input type="submit" value="Dodaj obrazek" name="submit">
            </form> -->
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