<?php
include("../template/home-head.php");

if (isset($_GET['recipeId'])) {
    $conn = getConn();
    $id = $_GET['recipeId'];
    $sql = "SELECT * FROM recipes WHERE id = '$id'";
    $recipe = $conn->query($sql);
    $recipe = $recipe->fetch_assoc();
    $recipe['ingredients'] = json_decode($recipe['ingredients']);
    $recipe['instruction'] = json_decode($recipe['instruction']);
}

editMethod($recipe);

?>
<link rel="stylesheet" href="../css/recipe.css">
<title>Document</title>
</head>

<body class="main-box">
    <?php include("../template/header.php") ?>

    <main class=container>
        <div class="title">
            <h1><?php echo $recipe['title'] ?></h1>
            <form class="header-author flex-box">
                <input type="submit" value="<?php echo $recipe['author'] ?>" class="author button button--underline-hover">
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
</body>

</html>

<?php

function loadArray(array $array): void
{
    foreach ($array as $element) {
        echo "<li>" . $element . "</li>";
    }
}

function isAuthor(string $author): void
{
    if ($_SESSION['user_data']['username'] == $author) {
        echo
        "
        <textarea class='none' name='recipeId'>{$_GET['recipeId']}</textarea>
        <input type='submit' value='edit' name='submit' class='edit button button--white-border button--white-hover'>
        ";
    }
}

function editMethod(array $recipe): void
{
    if(empty($_GET["submit"])) return;
    if ($_GET['submit'] != 'edit') return;
    $_SESSION['edit_recipe'] = $recipe;
    print_r($_SESSION['edit_recipe']);
    header("Location: create.php");
}

?>