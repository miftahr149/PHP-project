<?php

include("../utility/function.php");
session_start();

function postMethod()
{
    if ($_SERVER["REQUEST_METHOD"] != "POST") return;

    $username = filter_input(
        INPUT_POST,
        "username",
        FILTER_SANITIZE_SPECIAL_CHARS
    );

    $password = filter_input(
        INPUT_POST,
        "password",
        FILTER_SANITIZE_SPECIAL_CHARS
    );

    if (empty($username) or empty($password)) {
        sendError("You haven't enter username or password!");
    }

    $user_data = getAccount($username);
    if (empty($user_data)) return;

    if (!password_verify($password, $user_data['password'])) {
        sendError("Incorect Password!");
        return;
    }

    $_SESSION["user_data"] = $user_data;
    header("Location: home.php");
}

function getAccount(string $username) : null | array | false
{   
    include("../utility/database.php");
    $sql = "SELECT * FROM account WHERE username = '$username'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        sendError('Incorect username!');
        return null;
    }

    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $row;
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
    <title>Login</title>
</head>

<body>

    <section class="login-page flex-box">
        <header class=login__header>
            <img src="../favicon.ico" alt="icon">
            <h1 class="login__header">MealMaster</h1>
            <p class="slogan">Login Page</p>
        </header>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method=post class="form flex-grow flex-box">
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

            <input type="submit" value="Login" class="button submit-button">
        </form>

        <?php postMethod() ?>

        <footer>
            <p>
                Don't have account?
                <a href=./register.php> Register </a>
            </p>

            <p class="copyright flex-box flex-center">
                &copy; MealMaster LLC. All rights reserved
            </p>
        </footer>
    </section>

</body>

</html>