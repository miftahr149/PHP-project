<?php include("../template/home-head.php") ?>
<link rel="stylesheet" href="../css/home.css?v=<?php echo time(); ?>">
<title>MealMaster</title>
</head>

<body class="flex-box">
    <?php include("../template/header.php") ?>

    <main class="main flex-grow bg-black">
        <?php header('create.php') ?>
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
                <h3>Trending Recipes</h3>
                <?php getMostTrendingRecipes() ?>
            </div>
        </div>
    </main>

    <script>
        const userRecipesContainer = document.querySelectorAll(".user-recipe");
        userRecipesContainer.forEach(userRecipe => {
            /* Adjust the title */
            if (userRecipe.value.length > 15) {
                userRecipe.value = userRecipe.value.slice(0, 14) + "...";
            }
        })
    </script>
</body>

</html>

<?php

function getUserRecipes(): void
{
    $conn = getConn();
    $author = getUserData('username');
    $sql = "SELECT * FROM recipes WHERE
        author = '$author';";

    $results = $conn->query($sql);

    foreach ($results as $result) {
        $title = $result['title'];
        $id = $result['id'];
        include("../template/user-recipes.php");
    }

    $conn->close();
}

function getMostTrendingRecipes(): void
{
    $conn = getConn();
    $sql = "SELECT * FROM recipes_stats ORDER BY likeNumber DESC LIMIT 3";
    $results = $conn->query($sql);

    foreach ($results as $result) {
        extract($result);
        $sql = "SELECT * FROM recipes WHERE id = '$id'";
        $recipeData = $conn->query($sql)->fetch_assoc();
        extract($recipeData);
        include("../template/recipe-card.php");
    }
}

?>