<link rel="stylesheet" href="../css/header.css?v=<?php echo time() ?>">

<header class="header bg-black flex-box">
    <section class="header__left flex-grow flex-box">
        <a href="../view/home.php" class="">
            <img src="../favicon.ico" alt="meal master icon" width=32 height=32>
        </a>
        <a href="" class="header__menu flex-box flex-center">Explore</a>
        <a href="" class="header__menu flex-box flex-center">Favorite</a>
    </section>

    <section class="header__right">
        <a href="" class="header__menu flex-box flex-center">
            <?php echo getUserData('username') ?>
        </a>
    </section>

    <section class="header-tiny flex-box flex-grow">
        <button class="menu-button button" onclick="menuFunction()">
            <img src="../img/menu.ico" alt="" width=32 height=32>
        </button>

        <a class="flex-box flex-center flex-grow" href="../view/home.php">
            <img src="../favicon.ico" alt="" width=32 height=32>
        </a>
    </section>
</header>

<nav class="menu bg-black none" id="menu">
    <a href="" class="menu__item button button--white-hover">Explore</a>
    <a href="" class="menu__item button button--white-hover">Favorite</a>
    <a href="" class="menu__item button button--white-hover">
        <?php echo getUserData('username') ?>
    </a>
</nav>

<script src="../js/header.js"></script>