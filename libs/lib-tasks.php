<?php
use Illuminate\Contracts\Pagination\Paginator;

// func folders

function addFolder()
{
    return 1;
}

function getFolders()
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = 'select * from `folders` where `user_id` =' . $currentUserId;
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $record;
}

function deleteFolder(int $id = null)
{
    global $pdo;
    $sql = 'delete from `folders` where `id` =' . $id;
    $stmt = $pdo->prepare($sql);
    return $stmt->execute() ? null : diePage();
}

// func tasks

function addTask()
{
    return 1;
}

function getTasks()
{
    return 1;
}

function deleteTask()
{
    return 1;
}