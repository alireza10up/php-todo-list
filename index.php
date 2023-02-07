<?php

// init 
include 'bootstrap/init.php';

// logout
if(isset($_GET['logout'])) logout();

// check login
if(!isLoggedIn()) redirectTool('auth.php');

// request handeling
if (isset($_GET['deleteFolderId']) && is_numeric($_GET['deleteFolderId'])) {
    deleteFolder($_GET['deleteFolderId']);
}
if (isset($_GET['deleteTaskId']) && is_numeric($_GET['deleteTaskId'])) {
    deleteTask($_GET['deleteTaskId']);
}

// get data
$folders = getFolders();
$tasks = getTasks();
// view
include BASE_PATH . 'tpls/tpl-index.php';
