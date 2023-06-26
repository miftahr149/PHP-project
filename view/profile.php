<?php
include("../template/home-head.php");
$profileData = getProfileData();
?>
<link rel="stylesheet" href="../css/profile.css?v=<?php echo time(); ?>">
<title><?php echo ucfirst($profileData['username']) ?></title>
</head>

<body class="flex-box">
    <?php include("../template/header.php") ?>

    <main class="main flex-box flex-grow">
        <div class="user-profile flex-box box--padding">
            <div class="user-profile__left flex-grow">
                <p class="username"><?php echo $profileData['username'] ?></p>
            </div>
            <div class="user-profile__right flex-box flex-grow">
                <?php changeBackground($profileData) ?>
            </div>
        </div>

        <div class="edit-window-wrapper flex-box flex-center none">
            <div class="edit-window flex-box">
                <div class="edit__header">
                    <button class="back-button" onclick="editFunction()"></button>
                </div>
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="edit flex-grow">
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
                        <label for="backgroundImage">Background Image </label>
                        <input type="file" name="backgroundImage" class="edit__input" value="<?php $profileData['background_image'] ?>">
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

function getBackground(string $background): string | null
{
    if (empty($background)) return null;
}

function changeBackground(array $profileData): void
{
    if ($profileData['username'] !== getUserData('username')) return;
    echo
    '
    <button class="edit-button button button--white-border button--white-hover" onclick="editFunction()">Edit</button>
    ';
}

?>