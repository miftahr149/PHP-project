<?php
include("../template/home-head.php");
formMethod();
$profileData = getProfileData();
?>

<link rel="stylesheet" href="../css/profile.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="../css/recipe-card.css?v=<?php echo time(); ?>">
<title><?php echo ucfirst($profileData['username']) ?></title>
</head>

<body class="flex-box">
    <?php include("../template/header.php") ?>

    <main class="main flex-box flex-grow">
        <div class="background__container">
            <div class="background flex-box" style="<?php getBackground($profileData) ?>">
                <div class="background__filler flex-box flex-grow box--padding">
                    <p><?php echo $profileData['first_name'] . " " . $profileData['last_name'] ?></p>
                    <p class="username"><?php echo $profileData['username'] ?></p>
                </div>
                <div class="background__filler flex-box flex-grow box--padding">
                    <div class="edit-button__wrapper flex-box">
                        <?php editProfile($profileData) ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="container flex-grow">
            <h2 class="container__header container__header--hr">Recipes</h2>
            <?php getUserRecipes($profileData) ?>
        </div>
    </main>

    <div class="black-screen flex-box flex-center none" id="edit">
        <div class="black-screen--window black-screen--window-height flex-box">
            <div class="edit__header edit-window--padding">
                <button class="back-button" onclick="showFunction('#edit')"></button>
            </div>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" class="edit edit-window--padding flex-grow">
                <div class="flex-box" style="gap: 1.5rem">
                    <div class="flex-grow">
                        <p class="block">First Name</p>
                        <input type="text" name="firstName" class="edit__input" value="<?php echo $profileData['first_name'] ?>">
                    </div>
                    <div class="flex-grow">
                        <p class="block">Last Name</p>
                        <input type="text" name="lastName" class="edit__input" value="<?php echo $profileData['last_name'] ?>">
                    </div>
                </div>

                <div class="edit--margin-top" style="margin-top: 1rem">
                    <p>Background Image </p>
                    <input type="file" name="imageBackground" class="edit__input" value="<?php echo $profileData['image_background'] ?>">
                </div>

                <div class="flex-box edit--margin-top" style="gap: 1.5rem;">
                    <div class="flex-grow">
                        <p class="block">City</p>
                        <input type="text" name="city" class="edit__input" value="<?php echo $profileData['city'] ?>">
                    </div>
                    <div class="flex-grow">
                        <p class="block">Country</p>
                        <input type="text" name="country" class="edit__input" value="<?php echo $profileData['country'] ?>">
                    </div>
                </div>

                <div class="edit--margin-top">
                    <p class="block">Bio</p>
                    <textarea name="bio" rows="2" class="edit__input">
                        <?php echo $profileData['bio'] ?>
                    </textarea>
                </div>

                <div class="button__wrapper edit--margin-top">
                    <input type="submit" name="editProfile" value="Edit" class="edit__button button">
                </div>
            </form>
        </div>
    </div>

    
    <div class="black-screen flex-box flex-center none" style="<?php isBackgroundChange(); ?>" id="editBackground">
        <div class="black-screen--window flex-box edit-window--padding">
            <button class="back-button" onclick="showFunction('#editBackground')"></button>
            <h2 class="black-screen--header">Position your background image</h2>
            <div class="background__container">
                <div class="background" style="<?php getBackground($profileData) ?>" id="backgroundEdit">
                    <div class="background__filler flex-box" style="padding: 2vh 5vw">
                        <p><?php echo $profileData['first_name'] . " " . $profileData['last_name'] ?></p>
                        <p class="username"><?php echo $profileData['username'] ?></p>
                    </div>
                </div>
            </div>
            
            <form action="" method="get">
                <input type="text" id="topBackground" name="topBackground" class=none value="0">
                <input type="text" name="username" value=<?php echo $profileData['username'] ?> class="none">
                <input type="submit" name="editBackground" value="Confirm" class="button edit-background-button">
            </form>
        </div>
    </div>

    <script src="../js/profile.js"></script>

</body>


<?php

function getProfileData(): array
{
    $conn = getConn();

    $username = $_GET['username'];
    $sql = "SELECT * FROM account WHERE username='$username'";
    $profileData = $conn->query($sql)->fetch_assoc();
    $sql = "SELECT * FROM recipes WHERE author = '$username'";
    $profileData['recipes'] = $conn->query($sql)->fetch_all();

    $conn->close();
    return $profileData;
}

function formMethod(): void
{
    if (isset($_GET['editBackground'])) editBackgroundFunction();
    if (isset($_POST['editProfile'])) editProfileFunction();
}

function getBackground(array $profileData): void
{
    $text = "background-size: cover;
             background-position: center;";
    if (empty($profileData['image_background'])) {
        echo
        "
        background: linear-gradient(90deg, rgba(5, 5, 6, 1) 0%, rgba(39, 39, 50, 1) 49%, rgba(79, 79, 79, 1) 87%);
        " . $text;
        return;
    };

    $background = $profileData['image_background'];
    $topBackground = $profileData['image_background_top'];

    echo
    "
    background: url('$background');
    top: $topBackground;
    " . $text;
}

function editProfile(array $profileData): void
{
    if ($profileData['username'] !== getUserData('username')) return;
    echo
    '
    <button class="edit-button button" onclick=showFunction("#edit")>Edit</button>
    ';
}

function editProfileFunction(): void
{
    $destination = null;
    if (
        isset($_FILES['imageBackground']) and
        $_FILES['imageBackground']['error'] === UPLOAD_ERR_OK
    ) {
        $destination = storeImageBackground();
    }

    $id = getUserData('id');

    extract($_POST);
    $conn = getConn();
    $sql = "UPDATE account SET
            first_name = '$firstName',
            last_name = '$lastName',
            bio = '$bio',
            city = '$city'," .
        $destination .
        "country = '$country'" .
        "WHERE id = '$id'";
    $conn->query($sql);
    $conn->close();
}

function storeImageBackground(): string
{
    $file = $_FILES['imageBackground'];
    $destination = "../uploads/" . getUserData("username") . '.jpg';
    move_uploaded_file($file['tmp_name'], $destination);
    return "image_background = '$destination',";
}

function isBackgroundChange(): void
{
    if (empty($_FILES['imageBackground'])) return;
    if ($_FILES['imageBackground']['error'] !== UPLOAD_ERR_OK) return;
    echo "display: flex";
}

function editBackgroundFunction(): void
{
    extract($_GET);
    $conn = getConn();
    $sql = "UPDATE account SET image_background_top = '$topBackground' WHERE username = '$username'";
    $conn->query($sql);
    $conn->close();
}

function getUserRecipes(array $profileData): void
{
    $conn = getConn();
    $username = $profileData['username'];
    $sql = "SELECT * FROM recipes WHERE author = '$username'";

    $results = $conn->query($sql);
    foreach ($results as $result) {
        extract($result);
        $sql = "SELECT * FROM recipes_stats WHERE id = '$id'";
        $recipeData = $conn->query($sql)->fetch_assoc();
        extract($recipeData);
        include("../template/recipe-card.php");
    }
}

?>