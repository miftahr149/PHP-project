<?php include("../template/test.php") ?>
<link rel="stylesheet" href="../css/home.css?v=<?php echo time(); ?>">
<title>MealMaster</title>
</head>

<body class="flex-box">
    <?php include("../template/header.php") ?>

    <main class="main flex-grow bg-black">
        <div class="main__navbar">
            <a href="../view/create.php" class="create-ingredients flex-box flex-center">
                <img src="../img/plus.ico" alt="profile" title="Profile">
                <p class="flex-grow">Create Ingredients</p>
            </a>
        </div>


        <div class="main__content">
            <div class="user-repo main-box--wrapper">
                <h3>Repositories</h3>
                <div class="main-box">
                    <a href="../view/create.php" class="create-ingredients flex-box flex-center">
                        <img src="../img/plus.ico" alt="profile" title="Profile">
                        <p class="flex-grow">Create Ingredients</p>
                    </a>
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