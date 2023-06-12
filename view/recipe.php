<?php
include("../template/home-head.php");

$conn = getConn();
$title = $_GET['recipeTitle'];
$sql = "SELECT * FROM recipes WHERE title = '$title'";
$recipe = $conn->query($sql);
$recipe = $recipe->fetch_assoc();
$recipe['ingredients'] = json_decode($recipe['ingredients']);
$recipe['instruction'] = json_decode($recipe['instruction']);

?>
<style>
    body {
        background-color: #0d1117;
        color: var(--white);
    }

    .title {
        border-bottom: 2px solid white;
        padding-bottom: 1.5rem;
        margin-bottom: 2rem;
    }

    .author {
        margin-top: 0.5rem;
        font-size: 1.5rem;
    }

    .content-box {
        border-radius: 10px;
        border: 1px solid white;
        margin-bottom: 1.5rem;
        padding: 1rem;
    }

    .content-box h2 {
        margin-bottom: 1rem;
    }

    .content {
        padding: 0 1.5rem;
        line-height: 1.5;
    }

    .content--no-padding {
        padding: 0;
    }

    .content--paragraph {
        text-align: justify;
    }

    .content li {
        padding-bottom: 1rem;
    }
</style>
<title>Document</title>
</head>

<body class="main-box">
    <?php include("../template/header.php") ?>

    <main class=container>
        <div class="title">
            <h1><?php echo $recipe['title'] ?></h1>
            <form>
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
    </main>
</body>

</html>

<?php

function loadArray(array $ingredients): void
{

    foreach ($ingredients as $ingredient) {
        echo "<li>" . $ingredient . "</li>";
    }
}

?>