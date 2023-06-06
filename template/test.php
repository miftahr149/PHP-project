<?php

session_start();
include("../utility/function.php");
isLog();

function getUserData(string $property): mixed
{
    return $_SESSION['user_data'][$property];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=icon type=image/x-icon href=../favicon.ico>
    <link rel="stylesheet" href="../css/utility.css?v=<?php echo time(); ?>">