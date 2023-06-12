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

function createTable(mysqli $conn): void
{
    #creating account table
    $sql = "CREATE TABLE account (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username CHAR(25),
        password VARCHAR(255),
        reg_date DATE DEFAULT CURRENT_TIMESTAMP
    );";

    if ($conn->query($sql) === true) echo "Success Creating Account Table";
    else echo "Error Creating Account Table";

    #creating ingridients table
    $sql = "CREATE TABLE recipes (
        author CHAR(25) NOT NULL,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        ingredients JSON,
        instruction JSON,
        views INT(10) DEFAULT 0,
        created_at DATE DEFAULT CURRENT_TIMESTAMP
    );";

    if ($conn->query($sql) === true) echo "Success Creating Recipes Table";
    else echo "Error Creating Recipes Table";
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
    if (!isDatabaseExist($databaseName, $conn)) {
        createDatabase($databaseName, $conn);
        $conn = new mysqli($db_server, $db_user, $db_pass, $databaseName);
        createTable($conn);
    }
    $conn = new mysqli($db_server, $db_user, $db_pass, $databaseName);
    return $conn;
}