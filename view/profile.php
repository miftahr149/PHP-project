<?php
include("../template/home-head.php");
editMethod();
$profileData = getProfileData();
?>
<link rel="stylesheet" href="../css/profile.css?v=<?php echo time(); ?>">
<title><?php echo ucfirst($profileData['username']) ?></title>
</head>

<body class="flex-box">
    <?php include("../template/header.php") ?>

    <main class="main flex-box flex-grow">
        <div class="user-profile flex-box box--padding" style="<?php getBackground($profileData['image_background']); ?>">
            <div class="user-profile__left flex-grow">
                <p class="username"><?php echo $profileData['username'] ?></p>
            </div>
            <div class="user-profile__right flex-box flex-grow">
                <?php editProfile($profileData) ?>
            </div>
        </div>

        <div class="edit-window-wrapper flex-box flex-center none">
            <div class="edit-window flex-box">
                <div class="edit__header edit-window--padding">
                    <button class="back-button" onclick="editFunction()"></button>
                </div>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" class="edit edit-window--padding flex-grow">
                    <div class="flex-box" style="gap: 1.5rem">
                        <div class="flex-grow">
                            <label for="firstName" class="block">First Name</label>
                            <input type="text" name="firstName" class="edit__input" value="<?php $profileData['first_name'] ?>">
                        </div>
                        <div class="flex-grow">
                            <label for="lastName" class="block">Last Name</label>
                            <input type="text" name="lastName" class="edit__input" value="<?php $profileData['last_name']?>">
                        </div>
                    </div>

                    <div class="edit--margin-top" style="margin-top: 1rem">
                        <label for="imageBackground">Background Image </label>
                        <input type="file" name="imageBackground" class="edit__input" value="<?php $profileData['image_background'] ?>">
                    </div>

                    <div class="flex-box edit--margin-top" style="gap: 1.5rem;">
                        <div class="flex-grow">
                            <label for="city" class="block">City</label>
                            <input type="text" name="city" class="edit__input" value="<?php $profileData['city'] ?>">
                        </div>
                        <div class="flex-grow">
                            <label for="country" class="block">Country</label>
                            <input type="text" name="country" class="edit__input" value="<?php $profileData['country'] ?>">
                        </div>
                    </div>

                    <div class="edit--margin-top">
                        <label for="bio" class="block">Bio</label>
                        <textarea name="bio" rows="2" class="edit__input">
                            <?php $profileData['bio'] ?>
                        </textarea>
                    </div>

                    <div class="button__wrapper edit--margin-top">
                        <input type="submit" value="Edit" class="edit__button button" name="edit">
                    </div>
                </form>
            </div>
        </div>

    </main>

    <script>
        const editWindowWrapper = document.querySelector('.edit-window-wrapper');
        const editFunction = () => editWindowWrapper.classList.toggle("none");
    </script>
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

function getBackground(string $background): void
{
    $text = "background-size: cover;
             background-position: center;";
    if (empty($background)) {
        echo
        "
        background: linear-gradient(90deg, rgba(5, 5, 6, 1) 0%, rgba(39, 39, 50, 1) 49%, rgba(79, 79, 79, 1) 87%);
        " . $text;
        return;
    };

    echo $text .
    "
    background: url('$background');
    ". $text;
}

function editProfile(array $profileData): void
{
    if ($profileData['username'] !== getUserData('username')) return;
    echo
    '
    <button class="edit-button button button--white-border button--white-hover" onclick="editFunction()">Edit</button>
    ';
}

function editMethod(): void
{
    if ($_SERVER["REQUEST_METHOD"] != "POST") return;
    if (empty($_FILES['imageBackground']) or 
        $_FILES['imageBackground']['error'] !== UPLOAD_ERR_OK) return;
    
    $file = $_FILES['imageBackground'];
    $destination = "../uploads/" . getUserData("username") . '.jpg';
    move_uploaded_file($file['tmp_name'], $destination);
    $id = getUserData('id');

    extract($_POST);
    $conn = getConn();
    $sql = "UPDATE account SET
            first_name = '$firstName',
            last_name = '$lastName',
            bio = '$bio',
            image_background = '$destination',
            city = '$city',
            country = '$country'
            WHERE id = '$id'";
    $conn->query($sql);
    $conn->close();
}

?>