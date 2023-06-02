<?php

session_start();
include("../utility/function.php");
isLog();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/utility.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/home.css?v=<?php echo time(); ?>">
    <link rel=icon type=image/x-icon href=../favicon.ico>
    <title>MealMaster</title>
</head>

<body class="flex-box">
    <header class="header bg-black flex-box">
        <section class="header__left flex-grow flex-box">
            <a href="<?php $_SERVER['PHP_SELF'] ?>" class="">
                <img src="../favicon.ico" alt="meal master icon" width=32 height=32>
            </a>
            <a href="" class="header__menu flex-box flex-center">Create</a>
            <a href="" class="header__menu flex-box flex-center">Explore</a>
            <a href="" class="header__menu flex-box flex-center">Favorite</a>
        </section>

        <section class="header__right">
            <a href="" class="profile flex-box flex-center">
                <img src="../img/anonym.jpg" alt="" width=32 height=32>
            </a>
        </section>
    </header>

    <main class="main flex-grow bg-black">
        <div class="main__navbar">
            <a href="" class="create-ingredients flex-box flex-center">
                <img src="../img/plus.ico" alt="profile" title="Profile">
                <p class="flex-grow">Create Ingredients</p>
            </a>
        </div>


        <div class="main__content">
        </div>
    </main>

</body>

</html>