<?php

function set_todo(object $pdo, string $todo_title, string $todo_description, string $todo_date, int $user_id)
{
    $query = 'INSERT INTO tasks (
      title, description, date, user_id  
    ) VALUES (
        :title, :description, :date, :user_id
    );';

    $stmt = $pdo->prepare($query);
    $stmt->bindParam('title', $todo_title);
    $stmt->bindParam('description', $todo_description);
    $stmt->bindParam('date', $todo_date);
    $stmt->bindParam('user_id', $user_id);
    $stmt->execute();
}

function get_tasks(object $pdo, int $user_id, string $date)
{
    $query = "SELECT * FROM tasks WHERE user_id = :user_id AND date = :date;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam('user_id', $user_id);
    $stmt->bindParam('date', $date);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}

function delete_todo(object $pdo, int $id)
{
    $query = "DELETE FROM tasks WHERE id = :id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("id", $id);
    $stmt->execute();
}

function update_todo(object $pdo, int $id, string $title, string $description)
{
    $query = "UPDATE tasks SET title = :title, description = :description WHERE id = :id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("id", $id);
    $stmt->bindParam("title", $title);
    $stmt->bindParam("description", $description);
    $stmt->execute();
}

function get_todo_checked(object $pdo, int $id)
{
    $query = "SELECT checked FROM tasks WHERE id = :id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("id", $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function set_todo_checked(object $pdo, int $id, int $checked)
{
    $query = "UPDATE tasks SET checked = :checked WHERE id = :id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("id", $id);
    $stmt->bindParam("checked", $checked);
    $stmt->execute();
}

function set_profile_img(object $pdo, int $user_id, string $profile_img)
{
    $query = 'INSERT INTO profile_img (user_id, profile_img) VALUES (:user_id, :profile_img)';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("profile_img", $profile_img);
    $stmt->bindParam("user_id", $user_id);
    $stmt->execute();
}

function get_profile_img(object $pdo, int $user_id)
{
    $query = "SELECT profile_img, id FROM profile_img WHERE user_id = :user_id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("user_id", $user_id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

function update_profile_img(object $pdo, int $id, string $profile_img)
{
    $query = "UPDATE profile_img SET profile_img = :profile_img WHERE id = :id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("profile_img", $profile_img);
    $stmt->bindParam("id", $id);
    $stmt->execute();
}
