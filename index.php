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
    <?php include('template/header.html') ?>
    <main class="main flex-grow">

        <section class="home flex-box container">
            <section class="home__left flex-box">
                <h2 class="home__header">MealMaster</h2>
                <p>share your recipe to the world</p>
            </section>

            <section class="home__right flex-box flex-center">
                <img src="img/Recipe.png" alt="" height=256 width=256 class="img">
            </section>
        </section>

        <section class="about container flex-box">
            <section class="about__right flex-box flex-center flex-grow">
                <img src="img/Dishes.png" alt="" height="256" width=256 class="img">
            </section>
            <section class="about__left flex-box flex-grow">
                <h2 class="about__header">About</h2>
                <p class="about__description">
                    Our project aims to create an innovative recipe management website called MealMaster, where users can organize, discover, and share their favorite recipes. With MealMaster, users can effortlessly store and categorize their recipes, making meal planning and cooking a breeze. Our platform offers a vibrant community where users can share their culinary creations, explore a wide range of public recipes, and engage in rating and reviews. With features like favorites and a convenient shopping list generator, MealMaster empowers users to unleash their culinary creativity and embark on a delightful gastronomic journey.
                </p>
            </section>
        </section>
    </main>
    <?php include('template/footer.html') ?>