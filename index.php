<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/utility.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
    <link rel=icon type=image/x-icon href=favicon.ico>
    <title>MealMaster</title>
</head>

<body>
    <section class="header__wrapper">
        <header class="header bg-black flex-box container">
            <section class="header__left flex-box flex-grow">
                <img src="favicon.ico" alt="" width=32 height=32>
                <h1 class="fg-white title">MealMaster</h1>
            </section>
            <section class="header__right flex-box flex-grow">

                <section class="header__nav flex-grow flex-box">
                    <a href="view/login.php" class="menu-bar flex-grow flex-box flex-center">
                        Log in
                    </a>
                    <a href="view/register.php" class="menu-bar flex-grow  flex-box flex-center">
                        Register
                    </a>
                </section>
                <button class="button fg-white menu-button">
                    <img src="img/menu.ico" alt="aaa">

                    <nav class="nav-bar bg-black" id="nav-bar">
                        <a href="view/login.php" class="nav-bar-menu menu-bar bg-black flex-grow">Log in</a>
                        <a href="view/register.php" class="nav-bar-menu menu-bar bg-black flex-grow">Register</a>
                    </nav>
                </button>
            </section>
        </header>
    </section>

    <main class="main flex-grow">

        <section class="home container flex-box bg-black fg-white">
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
                    MealMaster is a user-friendly recipe management platform that simplifies organization, inspires creativity, and connects food enthusiasts in a vibrant community.
                </p>
            </section>
        </section>

        <section class="testimony container main--box">
            <h2 class="container__header">Testimony</h2>
            <section class="card-container">
                <section class="testimony-card flex-box">
                    <p class="card__content flex-grow">
                        MealMaster is a game-changer for my cooking - it's easy
                        to use, keeps me organized, and sparks my culinary
                        creativity!
                    </p>
                    <p class="card__name">Sarah W., Cooking Enthusiast</p>
                </section>
                <section class="testimony-card flex-box">
                    <p class="card__content flex-grow">
                        Thanks to MealMaster, cooking has become a delightful
                        adventure, with an array of recipes at my fingertips
                        and a seamless organization system.
                    </p>
                    <p class="card__name">John P., Food Lover</p>
                </section>
                <section class="testimony-card flex-box">
                    <p class="card__content flex-grow">
                        MealMaster is my secret ingredient for culinary success
                        - it simplifies recipe management and fuels my
                        inspiration in the kitchen.
                    </p>
                    <p class="card__name">Lisa M., Cooking Enthusiast</p>
                </section>
            </section>
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