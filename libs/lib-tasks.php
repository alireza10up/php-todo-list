<?php

use Illuminate\Contracts\Pagination\Paginator;

// func folders

function addFolder($folderName)
{
    // check length
    if (strlen($folderName) < 2 || strlen($folderName) > 100 || empty($folderName)) return INVALID_LENGTH;
    // check limit
    if (isset($_COOKIE['limitFolder'])) return YOU_HAVE_TAKEN_ACTION_RECENTLY;
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = 'INSERT INTO `folders` (`name` , `user_id`) VALUES (:folderName , :userId)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':folderName' => $folderName, ':userId' => $currentUserId]);
    // set limit
    setcookie('limitFolder', true, time() + 5, '/');
    return $pdo->lastInsertId();
}

function getFolders()
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "select * from `folders` where `user_id` = {$currentUserId} ORDER BY `id` ASC";
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
