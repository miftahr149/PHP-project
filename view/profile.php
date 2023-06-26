<?php
include("../template/home-head.php");
$profileData = getProfileData();
?>
<link rel="stylesheet" href="../css/recipe.css?v=<?php echo time(); ?>">
<title><?php echo ucfirst($profileData['username']) ?></title>

<style>
    /* Utility */
    .box--padding {
        padding: 10vh 15vw;
    }

    .block {
        display: block;
    }

    /* Main */
    .main {
        flex-direction: column;
    }

    /* user-profile */
    .user-profile {
        background: rgb(5, 5, 6);
        background: linear-gradient(90deg, rgba(5, 5, 6, 1) 0%, rgba(39, 39, 50, 1) 49%, rgba(79, 79, 79, 1) 87%);
    }

    .username {
        font-size: 2rem;
    }

    .user-profile__right {
        justify-content: right;
    }

    .edit-button {
        padding: .3rem .5rem;
    }

    /* Edit Window */

    .edit-window-wrapper {
        position: absolute;
        top: 0;
        left: 0;

        background-color: hsl(0, 0%, 0%, 50%);
        width: 100vw;
        height: 100vh;
    }

    .edit-window {
        border-radius: 10px;
        background-color: var(--white);
        width: 60vw;
        height: 80vh;

        flex-direction: column;
        color: var(--black);
    }

    .edit-window--padding {
        padding: 2vw 5vh;
    }

    .edit__header {
        box-shadow: 0 0 10px rgba(0, 0, 0, .5);
        padding: 2vh 2vw;
    }

    .back-button {
        background-color: transparent;
        background-size: cover;
        width: 32px;
        height: 32px;
        border: 0;
        color: transparent;

        transition: 500ms ease-in-out;
        background-image: url("../img/left.ico");
    }

    .back-button:hover {
        width: 36px;
        height: 36px;
    }

    .edit {
        overflow-y: auto;
    }

    .edit--margin-top {
        margin-top: 1rem;
    }

    .edit__input {
        width: 100%;
        padding: .2rem .5rem;
    }

    textarea.edit__input {
        max-width: 100%;
        min-width: 100%;

        padding: .5rem 1rem;
    }

    .edit__button {
        background-color: green;
        padding: .2rem .3rem;
        color: white;
    }
</style>

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
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="edit flex-grow edit-window--padding">
                    <div class="flex-box" style="gap: 1.5rem">
                        <div class="flex-grow">
                            <label for="firstName" class="block">First Name</label>
                            <input type="text" name="firstName" class="edit__input">
                        </div>
                        <div class="flex-grow">
                            <label for="lastName" class="block">Last Name</label>
                            <input type="text" name="lastName" class="edit__input">
                        </div>
                    </div>

                    <div class="edit--margin-top" style="margin-top: 1rem">
                        <label for="backgroundImage">Background Image </label>
                        <input type="file" name="backgroundImage" class="edit__input">
                    </div>

                    <div class="flex-box edit--margin-top" style="gap: 1.5rem;">
                        <div class="flex-grow">
                            <label for="city" class="block">City</label>
                            <input type="text" name="city" class="edit__input">
                        </div>
                        <div class="flex-grow">
                            <label for="country" class="block">Country</label>
                            <input type="text" name="country" class="edit__input">
                        </div>
                    </div>

                    <div class="edit--margin-top">
                        <label for="bio" class="block">Bio</label>
                        <textarea name="bio" rows="2" class="edit__input"></textarea>
                    </div>

                    <div class="edit--margin-top">
                        <input type="submit" value="Edit" class="edit__button button">
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