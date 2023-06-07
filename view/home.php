<?php include("../template/home-head.php") ?>
<link rel="stylesheet" href="../css/home.css?v=<?php echo time(); ?>">
<title>MealMaster</title>
</head>

<body class="flex-box">
    <?php include("../template/header.php") ?>

    <main class="main flex-grow bg-black">
        <div class="main__navbar">
            <a href="../view/create.php" class="create-ingredients flex-box flex-center">
                <img src="../img/plus.ico" alt="profile" title="Profile">
                <p class="flex-grow">Create Recipes</p>
            </a>
            <div class="user-recipes-box">
                <p>Repository</p>
                <?php getUserRecipes() ?>
            </div>
        </div>


        <div class="main__content flex-grow">
            <div class="user-repo main-box--wrapper">
                <h3>Repositories</h3>
                <div class="main-box">
                    <a href="../view/create.php" class="create-ingredients flex-box flex-center">
                        <img src="../img/plus.ico" alt="profile" title="Profile">
                        <p class="flex-grow">Create Recipes</p>
                    </a>
                    <div class="user-recipes-box user-recipes-box--padding">
                        <?php getUserRecipes() ?>
                    </div>
                </div>
            </div>

            <div class="trending main-box--wrapper">
                <h3>Trending Ingredients</h3>
            </div>
        </div>
    </main>

    <script src="../js/home.js"></script>
</body>

</html>

<?php

function getUserRecipes():void
{
    $conn = getConn();
    $author = getUserData('username');
    $sql = "SELECT * FROM recipes WHERE
        author = '$author';";

    $results = $conn->query($sql);

    foreach ($results as $result) {
        $title = $result['title'];
        include("../template/user-recipes.php");
    }

    $conn->close();
}

function gotoRecipe():void
{
    $recipeTitle = filter_input(INPUT_GET, 'recipe', FILTER_SANITIZE_SPECIAL_CHARS);
    if ($_SERVER['REQUEST_METHOD'] != 'GET' and
        empty($recipeTitle)) return;
    
    $_SESSION['recipe_title'] = $recipeTitle;
    header("Location: recipe.php");
}

?>