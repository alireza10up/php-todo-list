<?php

function createUrl(string $path = null)
{
    return BASE_URL . $path;
}

function diePage(string $msg = A_PROBLEM_OCCURRED)
{
    echo "<div style='width: 80%; color: #6e3030; padding: 1.2rem 1rem; margin: 1rem auto; background: #edbdbd; font-family: sans-serif; border-radius: 5px; border: solid #d1a7a7;'>{$msg}</div>";
    die();
}