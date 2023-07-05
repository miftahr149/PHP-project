<link rel="stylesheet" href="../css/header.css?v=<?php echo time() ?>">

<header class="header bg-black flex-box">
    <section class="header__left flex-grow flex-box">
        <a href="../view/home.php" class="">
            <img src="../favicon.ico" alt="meal master icon" width=32 height=32>
        </a>
        <a href="" class="header__menu flex-box flex-center">Explore</a>
        <a href="" class="header__menu flex-box flex-center">Saved</a>
    </section>

    <section class="header__right">
        <form action="../view/profile.php" method="get" class="flex-box flex-center">
            <input type="submit" name="username" value="<?php echo getUserData('username') ?>" class="header__menu button flex-box flex-center">
        </form>
        <form action="" method="post flex-box flex-center" method="post">
            <input type="submit" name="logout" value="Logout" class="logout header__menu button flex-box flex-center">
        </form>
    </section>

    <section class="header-tiny flex-box flex-grow">
        <button class="menu-button button" onclick="menuFunction()">
            <img src="../img/menu.ico" alt="" width=32 height=32>
        </button>

        <a class="flex-grow flex-center flex-box" href="../view/home.php">
            <img src="../favicon.ico" alt="" width=32 height=32>
        </a>
    </section>
</header>

<nav class="menu bg-black none" id="menu">
    <a href="" class="menu__item button button--white-hover">Explore</a>
    <a href="" class="menu__item button button--white-hover">Saved</a>
    <form action="../view/profile.php" method="get" class="flex-box">
        <input type="submit" value="<?php echo getUserData('username') ?>" class="menu__item button button--white-hover">
    </form>
</nav>

<script src="../js/header.js"></script>