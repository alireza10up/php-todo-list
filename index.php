<?php

// init 
include 'bootstrap/init.php';
// date pakage
use Hekmatinasser\Verta\Verta;

// request handeling
if (isset($_GET['deleteFolderId']) && is_numeric($_GET['deleteFolderId'])) {
    deleteFolder($_GET['deleteFolderId']);
}

// get data
$folders = getFolders();
// view
include BASE_PATH . 'tpls/tpl-index.php';
?>