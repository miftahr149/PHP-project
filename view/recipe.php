<?php
include("../template/home-head.php");

$conn = getConn();
$title = $_GET['recipeTitle'];
$sql = "SELECT * FROM recipes WHERE title = '$title'";
$recipe = $conn->query($sql);
$recipe = $recipe->fetch_assoc();

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
            <p><?php echo nl2br($recipe['description']) ?></p>
        </div>

        <div class="content-box">
            <h2>Ingredients</h2>
            <p><?php echo nl2br($recipe['ingredients']) ?><p>
        </div>

        <div class="content-box">
            <h2>Instruction</h2>
            <p><?php echo $recipe['instruction'] ?><p>
        </div>
    </main>
</body>

</html>

<?php

?>