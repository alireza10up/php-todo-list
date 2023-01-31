<?php

// security check
defined("BASE_PATH") or die('PERMISSION_DENIAL');

function createUrl(string $path = null)
{
    return BASE_URL . $path;
}

function isAjaxRequest()
{
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') return true;
    return false;
}

function diePage(string $msg = A_PROBLEM_OCCURRED)
{
    echo "<div style='width: 80%; color: #6e3030; padding: 1.2rem 1rem; margin: 1rem auto; background: #edbdbd; font-family: sans-serif; border-radius: 5px; border: solid #d1a7a7;'>{$msg}</div>";
    die();
}

function dd(mixed $var)
{
    echo "<pre style='background: #222; color: white; padding: 10px; margin: 10px; border-radius: 5px; border-left: 10px solid darkgrey;'>";
    var_dump($var);
    echo "</pre>";
}
