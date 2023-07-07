<?php

include("../utility/function.php");
include("../utility/database.php");
session_start();
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
    <title>Login</title>
</head>

<body>

    <section class="login-page flex-box">
        <header class="login__header">
            <img src="../favicon.ico" alt="icon" width=64 height=64>
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

<?php $conn->close(); ?>

<?php

function postMethod()
{
    if ($_SERVER["REQUEST_METHOD"] != "POST") return;

    $loginData = getLoginData();
    if (isEmpty($loginData)) return;

    extract($loginData);
    $user_data = getAccount($username);
    if (empty($user_data)) return;
    if (!password_verify($password, $user_data['password'])) {
        sendError("Incorect Password!");
        return;
    }
    
    $_SESSION["user_data"] = $user_data;
    header("Location: home.php");
}

function isEmpty(array $loginData): bool
{
    foreach($loginData as $key => $value) {
        if (empty($value)) return true;
    }
    return false;
}

function getLoginData(): array 
{
    $filter = function(string $property) {
        return filter_input(
            INPUT_POST,
            $property,
            FILTER_SANITIZE_SPECIAL_CHARS
        );
    };

    return array(
        'username' => $filter('username'),
        'password' => $filter('password')
    );
}

function getAccount(string $username) : null | array
{   
    global $conn;
    $sql = "SELECT * FROM account WHERE username = '$username'";
    $result = $conn->query($sql);

    if (mysqli_num_rows($result) == 0) {
        sendError('Incorect username!');
        return null;
    }

    $row = mysqli_fetch_assoc($result);
    return $row;
}

?>