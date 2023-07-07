<?php
include("../template/home-head.php");
$conn = getConn();
?>

<link rel="stylesheet" href="../css/saved.css">
<link rel="stylesheet" href="../css/recipe-card.css">
<title>Saved Recipes</title>
</head>

<body class="body--dark-theme">
    <?php include("../template/header.php") ?>

    <main class="container">
        <h2 class="container__header container__header--hr">Saved Recipes</h2>

        <div>
            <?php getSavedRecipes() ?>
        </div>
    </main>
</body>

</html>

<?php $conn->close(); ?>

<?php

function getSavedRecipes(): void
{
    global $conn;
    $username = getUserData("username");
    $sql = "SELECT * FROM recipes_stats WHERE savedPeople LIKE '%$username%'";

    $results = $conn->query($sql);
    foreach ($results as $result) {
        extract($result);
        $sql = "SELECT * FROM recipes WHERE id='$id'";
        extract($conn->query($sql)->fetch_assoc());
        include("../template/recipe-card.php");
    }
}

?>