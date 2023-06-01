<?php

include("../utility/function.php");

function postMethod()
{
    if ($_SERVER['REQUEST_METHOD'] != 'POST') return;

    $username = filter_input(
        INPUT_POST,
        'username',
        FILTER_SANITIZE_SPECIAL_CHARS,
    );

    $password = filter_input(
        INPUT_POST,
        'password',
        FILTER_SANITIZE_SPECIAL_CHARS,
    );

    $confirm_password = filter_input(
        INPUT_POST,
        'password2',
        FILTER_SANITIZE_SPECIAL_CHARS,
    );



    if (empty($username) or empty($password) or empty($confirm_password)) {
        sendError("You haven't enter your username or password!");
    }

    if ($password != $confirm_password) {
        sendError("your password doesn't match with the confirm one!");
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    include("../utility/database.php");
    $sql = "INSERT INTO account (username, password)
            VALUES ('$username', '$password')";
    mysqli_query($conn, $sql);
    mysqli_close($conn);

    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css?v=<?php echo time(); ?>">
    <link rel=icon type=image/x-icon href=../favicon.ico>
    <title>Register</title>
</head>

<body>

    <section class="login-page flex-box">
        <header class="login__header">
            <img src="../favicon.ico" alt="">
            <h1>Meal Master</h1>
            <p class="slogan">Register Page</p>
        </header>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method=POST class="form flex-grow flex-box">
            <section>
                <label for="username" class="form__label">Username: </label>
                <input type="text" name="username" id="" class="form__input">
            </section>
            <section>
                <label for="password" class="form__label">Password: </label>
                <input type="password" name="password" class="form__input">
            </section>
            <section>
                <label for="password2" class="form__label">
                    Confirm Password:
                </label>
                <input type="password" name="password2" class="form__input">
            </section>

            <?php postMethod() ?>

            <input type="submit" value="Register" class="submit-button button">
        </form>

        <footer>
            <p>
                have account?
                <a href=login.php> Login </a>
            </p>

            <p class="copyright flex-box flex-center">
                &copy; MealMaster LLC. All rights reserved
            </p>
        </footer>
    </section>
</body>

</html>