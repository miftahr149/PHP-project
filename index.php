<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
    <link rel=icon type=image/x-icon href=favicon.ico>
    <title>MealMaster</title>
</head>

<body>
    <section class="header__wrapper">
        <header class="header bg-black flex-box container">
            <section class="header__left flex-box flex-grow">
                <img src="favicon.ico" alt="">
                <h1 class="fg-white title">MealMaster</h1>
            </section>
            <section class="header__right flex-box flex-grow">

                <section class="header__nav flex-grow flex-box">
                    <a href="view/login.php" class="menu-bar flex-grow fg-white flex-box flex-center">
                        Log in
                    </a>
                    <a href="view/register.php" class="menu-bar flex-grow fg-white flex-box flex-center">
                        Register
                    </a>
                </section>
                <button class="button fg-white menu-button">
                    <img src="img/menu.ico" alt="aaa">

                    <nav class="nav-bar bg-black" id="nav-bar">
                        <a href="view/login.php" class="nav-bar-menu menu-bar fg-white flex-grow">Log in</a>
                        <a href="view/register.php" class="nav-bar-menu menu-bar fg-white flex-grow">Register</a>
                    </nav>
                </button>
            </section>
        </header>
    </section>

    <main class="main flex-grow">

        <section class="home flex-box container bg-black fg-white">
            <section class="home__left flex-box">
                <h2 class="container__header">
                    Unleash Your Culinary Creativity with MealMaster
                </h2>
            </section>

            <section class="home__right flex-box flex-center">
                <img src="img/Recipe.png" alt="" height=256 width=256 class="img">
            </section>
        </section>

        <section class="about container flex-box flex-center">
            <section class="about__right flex-box flex-center flex-grow">
                <img src="img/Dishes.png" alt="" height="256" width=256 class="img">
            </section>
            <section class="about__left flex-box flex-grow">
                <h2 class="about__header container__header">About</h2>
                <p class="about__description">
                    Our project aims to create an innovative recipe management website called MealMaster, where users can organize, discover, and share their favorite recipes. With MealMaster, users can effortlessly store and categorize their recipes, making meal planning and cooking a breeze. Our platform offers a vibrant community where users can share their culinary creations, explore a wide range of public recipes, and engage in rating and reviews. With features like favorites and a convenient shopping list generator, MealMaster empowers users to unleash their culinary creativity and embark on a delightful gastronomic journey.
                </p>
            </section>
        </section>

        <section class="testimony container main-box bg-black fg-white">
            <h2 class="container__header">Testimony</h2>
        </section>
    </main>

    <footer class="footer bg-black fg-white flex-box container">
        <section class="contact">
            <h2 class="container__header">Contact Us</h2>
            <section class="contact-card flex-box">
                <img src="img/email.ico" alt="">
                <p>email: info@mealmaster.com</p>
            </section>
            <section class="contact-card flex-box">
                <img src="img/phone.ico" alt="">
                <p>Phone: +1 (555) 123-4567</p>
            </section>
            <section class="contact-card flex-box">
                <img src="img/address.ico" alt="">
                <p>Address: 123 Recipe Lane, Foodville, Cookland</p>
            </section>
        </section>
        <p class="copyright flex-box flex-center">
            &copy; MealMaster LLC. All rights reserved
        </p>
    </footer>
</body>

</html>