<?php

function sendError(string $error)
{
    echo
    "
    <p class='error'>{$error}</p>
    ";
}

function isLog(): void {
    if (empty($_SESSION['user_data'])) header('Location: ../index.php');
}