<?php

declare(strict_types=1);


function add_todo_handler(object $pdo, string $todo, int $user_id)
{
    set_todo($pdo, $todo, $user_id);
}

function todo_list_handler(object $pdo, int $user_id)
{

    return get_tasks($pdo, $user_id);
}


function remove_todo_handler(object $pdo, int $id)
{
    delete_todo($pdo, $id);
}

function edit_todo_handler(object $pdo, int $id, string $title)
{
    update_todo($pdo, $id, $title);
}

function toggle_todo_checkbox_handler(object $pdo, int $id)
{
    $checkedbox_status = get_todo_checked($pdo, $id);

    $new_checked_value = ($checkedbox_status['checked'] == 1) ? 0 : 1;

    set_todo_checked($pdo, $id, $new_checked_value);
}
