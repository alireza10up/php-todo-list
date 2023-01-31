<?php
// init
include_once dirname(__DIR__) . '/bootstrap/init.php';
// validation request
if (!isAjaxRequest()) diePage(INVALID_REQUEST);
// validation action
if (!isset($_POST['action']) || empty($_POST['action'])) diePage(INVALID_ACTION);
// process
echo match ($_POST['action']) {
    'addFolder' => addFolder(htmlspecialchars($_POST['folderName'] ?? 0)),
    'addTask' => addTask(htmlspecialchars($_POST['title'] ?? 0), htmlspecialchars($_POST['folderId'] ?? 0)),
    'switchTask' => switchTaskStatus(htmlspecialchars($_POST['taskId'] ?? 0)),
    default => diePage(INVALID_ACTION),
};
