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

$logoutFunction = function () {
    if ($_SERVER['REQUEST_METHOD'] != "GET") return null;
    if (empty($_GET['logout'])) return null;
    unset($_SESSION['user_data']);
    header("Locations: ../index.php");
};

$logoutFunction();

