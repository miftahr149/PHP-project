<?php

include("../utility/function.php");
include("../utility/database.php");
$conn = getConn();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/utility.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/login.css?v=<?php echo time(); ?>">
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

<?php $conn->close(); ?>

<?php

function postMethod()
{
    if ($_SERVER['REQUEST_METHOD'] != 'POST') return;
    $registerData = getRegisterData();
    if (!checkError($registerData)) return;
    registerUser($registerData);
    header("Location: login.php");
}

function getRegisterData(): array
{
    $filter = function (string $property) {
        return filter_input(
            INPUT_POST,
            $property,
            FILTER_SANITIZE_SPECIAL_CHARS,
        );
    };

    return array(
        "username" => $filter("username"),
        "password" => $filter("password"),
        "confirmPassword" => $filter("password2")
    );
}

function checkError(array $registerData): bool
{
    $errorFunction = function (string $errorMessage): bool {
        sendError($errorMessage);
        return false;
    };

    $isEmpty = function (array $registerData): bool {
        foreach ($registerData as $key => $value) {
            if (empty($value)) return true;
        };
        return false;
    };

    if ($isEmpty($registerData)) {
        return $errorFunction("You haven't enter your username or password!");
    }

    if ($registerData['password'] != $registerData['confirmPassword']) {
        return $errorFunction("your password doesn't match with the confirm one!");
    }

    return true;
}

function registerUser(array $registerData): void
{
    global $conn;
    extract($registerData);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO account (username, password)
            VALUES ('$username', '$password')";
    $conn->query($sql);
}

?>