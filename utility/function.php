<?php

function sendError(string $error)
{
    echo
    "
    <p class='error'>{$error}</p>
    ";
}

function isLogin(): void {
    if (empty($_SESSION['user_data'])) header('Location: ../index.php');
}

function getMostTrendingRecipes(): void
{
    $conn = getConn();
    $sql = "SELECT * FROM recipes_stats ORDER BY likeNumber DESC LIMIT 3";
    $results = $conn->query($sql);

    foreach ($results as $result) {
        extract($result);
        $sql = "SELECT * FROM recipes WHERE id = '$id'";
        $recipeData = $conn->query($sql)->fetch_assoc();
        extract($recipeData);
        include("../template/recipe-card.php");
    }
}

function getUserData(string $property): mixed
{
    return $_SESSION['user_data'][$property];
}

function isUserLogout():  void
{
    if ($_SERVER['REQUEST_METHOD'] != "GET") return;
    if (empty($_GET['logout'])) return;
    unset($_SESSION['user_data']);
    header("Locations: ../index.php");
}

