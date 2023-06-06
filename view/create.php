<?php include("../template/test.php") ?>
<link rel="stylesheet" href="../css/create.css?v=<?php echo time() ?>">
<title>Create</title>
</head>

<body>
    <?php include("../template/header.php") ?>

    <form action="<?php $_SERVER['PHP_SELF']?>" class="container create">
        <div class="create__item">
            <label for="title">Title: </label>
            <input type="text" placheolder="Title" id="title">
        </div>
        <div class="create__item">
            <label for="desc">Description: </label>
            <textarea id="desc"></textarea>
        </div>
        <div class="create__item">
            <label for="ingredients">Ingredients: </label>
            <textarea id="ingredients"></textarea>
        </div>
        <div class="create__item">
            <label for="instruction">Instruction: </label>
            <textarea id="Instruction"></textarea>
        </div>

        <div>
            <input type="submit" value="Create" class="create-button button button--white-hover">
        </div>
    </form>
</body>

</html>