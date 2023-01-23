<?php

// inc
include 'vendor/autoload.php';
include 'bootstrap/config.php';
include 'bootstrap/constants.php';
include 'libs/lib-helpers.php';

// con db
$dsn = "mysql:dbname=$dbConfig->db;host={$dbConfig->host}";

try {
    $pdo = new PDO($dsn, $dbConfig->user, $dbConfig->pass);
} catch (\Throwable $th) {
    diePage('Connection Faild : ' . $th->getMessage());
}

// data
include 'libs/lib-auth.php';
include 'libs/lib-tasks.php';

?>