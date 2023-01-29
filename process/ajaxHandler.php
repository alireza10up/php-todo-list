<?php
// init
include_once dirname(__DIR__) . '/bootstrap/init.php';
// validation request
if (!isAjaxRequest()) diePage(INVALID_REQUEST);
// validation action
if (!isset($_POST['action']) || empty($_POST['action'])) diePage(INVALID_ACTION);
// process
echo match ($_POST['action']) {
    'addFolder' => addFolder($_POST['folderName']),
    'addTask' => addTask($_POST['taskName']),
    default => diePage(INVALID_ACTION),
};
