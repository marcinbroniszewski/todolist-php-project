<?php

function set_todo(object $pdo, string $todo, int $user_id)
{
    $query = 'INSERT INTO tasks (
      title, user_id  
    ) VALUES (
        :todo, :user_id
    );';

    $stmt = $pdo->prepare($query);
    $stmt->bindParam('todo', $todo);
    $stmt->bindParam('user_id', $user_id);
    $stmt->execute();
}

function get_tasks(object $pdo, int $user_id, string $date)
{
    $query = "SELECT * FROM tasks WHERE user_id = :user_id AND DATE(created_at) = :date;";
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

function update_todo(object $pdo, int $id, string $title)
{
    $query = "UPDATE tasks SET title = :title WHERE id = :id;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam("id", $id);
    $stmt->bindParam("title", $title);
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
