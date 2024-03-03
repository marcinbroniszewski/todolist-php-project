<?php

declare(strict_types=1);

function add_todo_handler(object $pdo, string $todo_title, string $todo_description, string $todo_date, int $user_id)
{
    set_todo($pdo, $todo_title, $todo_description, $todo_date, $user_id);
}

function todo_list_handler(object $pdo, int $user_id, $date)
{
    return get_tasks($pdo, $user_id, $date);
}


function remove_todo_handler(object $pdo, int $id)
{
    delete_todo($pdo, $id);
}

function edit_todo_handler(object $pdo, int $id, string $title, string $description)
{
    update_todo($pdo, $id, $title, $description);
}

function toggle_todo_checkbox_handler(object $pdo, int $id)
{
    $checkedbox_status = get_todo_checked($pdo, $id);

    $new_checked_value = ($checkedbox_status['checked'] == 1) ? 0 : 1;

    set_todo_checked($pdo, $id, $new_checked_value);
}

function add_profile_img(object $pdo, int $user_id, string $profile_img)
{
    set_profile_img($pdo, $user_id, $profile_img);
}

function profile_img_handler(object $pdo, int $user_id) {
   return get_profile_img($pdo, $user_id);
}

function edit_profile_img(object $pdo, int $id, string $profile_img) {
    update_profile_img($pdo, $id, $profile_img);
}