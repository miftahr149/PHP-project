<?php
include("../template/home-head.php");

$recipe = getRecipeData();
getFormMethod();

?>
<link rel="stylesheet" href="../css/recipe.css?v=<?php echo time(); ?>">
<title><?php echo $title ?></title>
</head>

<body class="main-box">
    <?php include("../template/header.php") ?>

    <main class=container>
        <div class="title">
            <h1><?php echo $recipe['title'] ?></h1>
            <form class="header-author flex-box flex-grow" method="get">
                <?php formRecipeId() ?>
                <div class="header-author__left">
                    <input type="submit" value="<?php echo $recipe['author'] ?>" class="author button button--underline-hover">
                </div>
                <div class="header-author__right flex-box flex-grow">
                    <input type="submit" name="like" value="<?php echo isUser('likePeople') ?>" class="stats-button heart-button button">
                    <input type="submit" name="save" value="<?php echo isUser('savedPeople') ?>" class="stats-button button save-button">
                </div>
            </form>
        </div>

        <div class="content-box">
            <h2>Description</h2>
            <p class="content content--no-padding content--paragraph"><?php echo nl2br($recipe['description']) ?></p>
        </div>

        <div class="content-box">
            <h2>Ingredients</h2>
            <ul class="content"><?php loadArray($recipe['ingredients']) ?><ul>
        </div>

        <div class="content-box">
            <h2>Instruction</h2>
            <ol class="content"><?php loadArray($recipe['instruction']) ?><ol>
        </div>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
            <?php isAuthor($recipe['author']) ?>
        </form>
    </main>

    <script src="../js/recipe.js"></script>
</body>

</html>

<?php

function getFormMethod(): void
{
    if (isset($_GET['edit'])) editMethod();
    if (isset($_GET['like'])) statsMethod('likePeople');
    if (isset($_GET['save'])) statsMethod('savedPeople');
}

function loadArray(array $array): void
{
    foreach ($array as $element) {
        echo "<li>" . $element . "</li>";
    }
}

function formRecipeId(): void
{
    echo "<textarea class='none' name='recipeId'>{$_GET['recipeId']}</textarea>";
}

function isAuthor(string $author): void
{
    if ($_SESSION['user_data']['username'] == $author) {
        formRecipeId();
        echo
        "
        <input type='submit' value='Edit' name='edit' class='edit button button--white-border button--white-hover'>
        ";
    }
}

function getRecipeData(): null | array
{
    if (empty($_GET['recipeId'])) return null;
    $conn = getConn();

    $id = $_GET['recipeId'];
    $sql = "SELECT * FROM recipes WHERE id = '$id'";
    $recipe = $conn->query($sql);
    $recipe = $recipe->fetch_assoc();
    $recipe['ingredients'] = json_decode($recipe['ingredients']);
    $recipe['instruction'] = json_decode($recipe['instruction']);

    $conn->close();
    return $recipe;
}

function getRecipeStats(): array
{
    $conn = getConn();
    $id = $_GET['recipeId'];
    $sql = "SELECT * FROM recipes_stats WHERE id='$id'";
    $result = $conn->query($sql);
    $result = $result->fetch_assoc();

    $result['likePeople'] = json_decode($result['likePeople']);
    $result['savedPeople'] = json_decode($result['savedPeople']);
    $conn->close();
    return $result;
}

function isUser(string $key): string
{
    $recipeStats = getRecipeStats();
    if (empty($recipeStats[$key]) or !in_array(getUserData('username'), $recipeStats[$key])) {
        return "false";
    }
    return "true";
}

function editMethod(): void
{
    $_SESSION['edit_recipe'] = getRecipeData();
    header("Location: create.php");
}

function statsMethod(string $key): void
{

    $create = function($key, $recipeStats) {
        $conn = getConn();
        $sqlArray = array(
            "likePeople" => function ($recipeStats) {
                $likeCount = $recipeStats['likeNumber'] + 1;

                if (isset($recipeStats['likePeople'])) {
                    array_push($recipeStats['likePeople'], getUserData('username'));
                } else {
                    $recipeStats['likePeople'] = array(getUserData('username'));
                }

                $likePeople = json_encode($recipeStats['likePeople']);
                $id = $recipeStats['id'];

                return "UPDATE recipes_stats 
                        SET likeNumber = '$likeCount', likePeople = '$likePeople'
                        WHERE id = '$id'";
            },

            "savedPeople" => function ($recipeStats) {
                if (isset($recipeStats['savedPeople'])) {
                    array_push($recipeStats['savedPeople'], getUserData('username'));
                } else {
                    $recipeStats['savedPeople'] = array(getUserData('username'));
                }

                $savedPeople = json_encode($recipeStats['savedPeople']);
                $id = $recipeStats['id'];
                return "UPDATE recipes_stats
                        SET savedPeople = '$savedPeople'
                        WHERE id = '$id'";
            }
        );

        $conn->query($sqlArray[$key]($recipeStats));
        $conn->close();
    };

    $delete = function($key, $recipeStats) {
        $conn = getConn();

        $sqlArray = array(
            "likePeople" => function($recipeStats) {
                $likeCount = $recipeStats['likeNumber'] - 1;
                $index = array_search(getUserData('username'), $recipeStats['likePeople']);
                unset($recipeStats['likePeople'][$index]);

                $likePeople = json_encode($recipeStats['likePeople']);
                $id = $recipeStats['id'];

                return "UPDATE recipes_stats 
                        SET likeNumber = '$likeCount', likePeople = '$likePeople'
                        WHERE id = '$id'";
            },

            "savedPeople" => function ($recipeStats) {
                $index = array_search(getUserData('username'), $recipeStats['savedPeople']);
                unset($recipeStats['savedPeople'][$index]);

                $savedPeople = json_encode($recipeStats['savedPeople']);
                $id = $recipeStats['id'];
                return "UPDATE recipes_stats
                        SET savedPeople = '$savedPeople'
                        WHERE id = '$id'";
            }
        );

        $conn->query($sqlArray[$key]($recipeStats));
        $conn->close();
    };

    if (isUser($key) === 'false') $create($key, getRecipeStats());
    else $delete($key, getRecipeStats());
}



?>