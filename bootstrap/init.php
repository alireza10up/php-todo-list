<?php

// time zone
date_default_timezone_set('Asia/Tehran');

// inc
include 'constants.php';
include BASE_PATH . 'bootstrap/config.php';
include BASE_PATH . 'libs/helpers.php';

// con db
$dsn = "mysql:dbname=$dbConfig->db;host={$dbConfig->host}";

try {
    $pdo = new PDO($dsn, $dbConfig->user, $dbConfig->pass);
} catch (\Throwable $th) {
    diePage('Connection Faild : ' . $th->getMessage());
}

// data
include BASE_PATH . 'libs/lib-auth.php';
include BASE_PATH . 'libs/lib-tasks.php';