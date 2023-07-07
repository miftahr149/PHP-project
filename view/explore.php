<?php
include("../template/home-head.php");
$conn = getConn();
?>

<link rel="stylesheet" href="../css/recipe.css?v=<?php echo time(); ?>">
<link rel="stylesheet" href="../css/recipe-card.css">
<title>Explore</title>
</head>

<body class="body--dark-theme">
    <?php include("../template/header.php") ?>

    <main class="container">
        <div>
            <h2 class="container__header container__header--hr">Trending Topics</h2>
            <?php getMostTrendingRecipes(); ?>
        </div>
    </main>
</body>

</html>

<?php $conn->close(); ?>