<?php

// init 
include 'bootstrap/init.php';

// check request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'register') $result = register($_POST);
    if ($_POST['action'] == 'login') $result = login($_POST);
}

// view
include BASE_PATH . 'tpls/tpl-auth.php';

// print result
if (isset($result))  echo $result == 1 ? "<script>swal('ok let s go !!!','your are sign up , please login', 'success');</script>" : "<script>swal('Oh No !!!','$result' , 'warning');</script>";
