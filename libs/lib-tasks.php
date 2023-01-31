<?php

// security check
defined("BASE_PATH") or die('PERMISSION_DENIAL');

// func folders

function addFolder($folderName)
{
    // check length
    if (strlen($folderName) < 2 || strlen($folderName) > 100 || empty($folderName)) return INVALID_LENGTH_FOLDER;
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
    $currentUserId = getCurrentUserId();
    $sql = 'delete from `folders` where `user_id` = :userId and `id` = :folderId';
    $stmt = $pdo->prepare($sql);
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':userId' => $currentUserId, ':folderId' => $id]);
    return $stmt->rowCount();
}

function countItemInFolder(int $id = null)
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $statment =  (is_null($id)) ? '' : 'and `folder_id` =' . $id;
    $sql = "select count(id) as total from `tasks` where `user_id` = {$currentUserId} {$statment} ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $record;
}

// func tasks

function addTask(string $title = null, $folderId = 0)
{
    // check length
    if (strlen($title) < 2 || strlen($title) > 500 || empty($title)) return INVALID_LENGTH_TASK;
    // check limit
    if (isset($_COOKIE['limitTask'])) return YOU_HAVE_TAKEN_ACTION_RECENTLY;
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = 'INSERT INTO `tasks` (`title` , `user_id` ,`folder_id`) VALUES (:title , :userId , :folderId)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':title' => $title, ':userId' => $currentUserId, ':folderId' => (int) $folderId]);
    // set limit
    setcookie('limitTask', true, time() + 5, '/');
    return $pdo->lastInsertId();
}

function getTasks()
{
    global $pdo;
    $folderQuery = '';
    if (isset($_GET['folderId']) && is_numeric($_GET['folderId'])) {
        $folderId = $_GET['folderId'];
        $folderQuery = "AND `folder_id` = {$folderId}";
    }
    $currentUserId = getCurrentUserId();
    $sql = "select * from `tasks` where `user_id` = {$currentUserId} {$folderQuery} ORDER BY `id` ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $record = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $record;
}

function deleteTask(int $id = null)
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = 'delete from `tasks` where `user_id` = :userId and `id` = :taskId';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':userId' => $currentUserId, ':taskId' => $id]);
    return $stmt->rowCount();
}

function switchTaskStatus(int $id = null)
{
    // check length
    if (empty($id) && is_numeric($id)) return INVALID_TASK_ID;
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = 'update `tasks` set `is_done` = 1 - is_done where user_id = :userId and id = :taskId';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':userId' => $currentUserId, ':taskId' => $id]);
    return $pdo->lastInsertId();
}
