<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time(); ?>">
    <link rel=icon type=image/x-icon href=../favicon.ico>
    <title>Login</title>
</head>

<body>

    <section class="login-page flex-box">
        <header class=login__header>
            <img src="../favicon.ico" alt="icon">
            <h1 class="container__header">MealMaster</h1>
            <p class="slogan">
                Unleash Your Culinary Creativity with MealMaster
            </p>
        </header>

        <form action="login.php" method=post class="form flex-grow flex-box">
            <section class="">
                <label for="username" class="form__label">
                    Username: 
                </label>
                <input type="text" name="username" class="form__input">
            </section>

            <section class="">
                <label for="password" class="form__label">Password: </label>
                <input type="password" name="password" class="form__input">
            </section>

            <input type="submit" name="Login" value="login" class="button">
        </form>

        <footer>
            <p>
                Don't have account? 
                <a href=./register.php class="nowrap"> Register </a>
            </p>

            <p class="copyright flex-box flex-center">
                &copy; MealMaster LLC. All rights reserved
            </p>
        </footer>
    </section>

</body>

</html>