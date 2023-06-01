<?php session_start() ?>

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
            <a href="" class="header__menu flex-box flex-center">Create Ingridents</a>
            <a href="" class="header__menu flex-box flex-center">Explore</a>
            <a href="" class="header__menu flex-box flex-center">Profile</a>
        </section>

        <section class="header__right"></section>
    </header>

    <main class="main flex-grow bg-black">
        <div class="main__navbar">navbar</div>
        <div class="main__content">content</div>
    </main>

</body>

</html>