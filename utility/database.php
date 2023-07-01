<?php

function isDatabaseExist(string $databaseName, mysqli $conn): bool
{
    $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA
            WHERE SCHEMA_NAME = '$databaseName'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) return false;
    return True;
}

function createDatabase(string $databaseName, mysqli $conn): void
{
    $sql = "CREATE DATABASE $databaseName";
    $conn->query($sql);
}

function createRecipesTable(mysqli $conn): void
{
    $sql = "CREATE TABLE recipes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        author CHAR(25) NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        ingredients JSON,
        instruction JSON,
        created_at DATE DEFAULT CURRENT_TIMESTAMP
    );";

    if ($conn->query($sql) === true) echo "Success Creating Recipes Table";
    else echo "Error Creating Recipes Table";
}

function createAccountTable(mysqli $conn): void
{
    $sql = "CREATE TABLE account (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username CHAR(25) UNIQUE,
        password VARCHAR(255),
        reg_date DATE DEFAULT CURRENT_TIMESTAMP,
        first_name VARCHAR(255),
        last_name VARCHAR(255),
        image_background VARCHAR(255),
        image_background_top VARCHAR(255) DEFAULT 0,
        bio TEXT,
        city VARCHAR(30),
        country VARCHAR(30)
    );";

    if ($conn->query($sql) === true) echo "Success Creating Account Table";
    else echo "Error Creating Account Table";
}

function createRecipesStatsTable(mysqli $conn): void
{
    $sql = "CREATE TABLE recipes_stats (
        id INT AUTO_INCREMENT PRIMARY KEY,
        likeNumber INT DEFAULT 0,
        likePeople JSON,
        savedPeople JSON
    );";

    if ($conn->query($sql) === true) echo "Success Creating Account Table";
    else echo "Error Creating Account Table";
}

function checkTable(mysqli $conn, string $table): bool
{
    $sql = "SHOW TABLES LIKE '$table'";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}

function getConn(): mysqli
{
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";


    $conn = new mysqli($db_server, $db_user, $db_pass);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $databaseName = "mealmaster";
    if (!isDatabaseExist($databaseName, $conn)) createDatabase($databaseName, $conn);
    $conn = new mysqli($db_server, $db_user, $db_pass, $databaseName);

    $tableArray = array(
        'account' => function ($conn) {
            createAccountTable($conn);
        },
        'recipes' => function ($conn) {
            createRecipesTable($conn);
        },
        'recipes_stats' => function ($conn) {
            createRecipesStatsTable($conn);
        }
    );

    foreach ($tableArray as $table => $createFunction) {
        if (!checkTable($conn, $table)) $createFunction($conn);
    }

    return $conn;
}
