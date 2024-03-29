<?php 
include("../template/home-head.php");
formMethod();
$state = getState(); 
$editRecipeData = getEditRecipeData($state);
?>


<link rel="stylesheet" href="../css/create.css?v=<?php echo time() ?>">
<title><?php echo ucfirst($state) ?></title>
</head>

<body>
    <?php include("../template/header.php") ?>


    <main class="container">
        <h1 class="title">Create New Repository</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" class="create" method="get">

            <div class="create__item">
                <label for="title">Title: </label>
                <textarea rows=1 name="title"><?php echo getRecipe('title') ?></textarea>
            </div>

            <div class="create__item">
                <label for="desc">Description: </label>
                <textarea rows=1 name="desc"><?php echo getRecipe('description') ?></textarea>
            </div>

            <div class="create__item">
                <label for="ingredients">Ingredients: </label>
                <section class="wrapper-border flex-box">
                    <ul class="list" id="ingredients">
                        <?php getRecipeArray("ingredients") ?>
                    </ul>
                    <section class="button-container flex-box">
                        <div class="create-list button" onclick="createList('ingredients')">
                            Create List
                        </div>
                        <div class="copy button" onclick="copyConfigure('ingredients')">
                            Copy
                        </div>
                        <div class="delete-all button" onclick="deleteAllFunction('ingredients')">
                            Delete All
                        </div>
                    </section>
                </section>
            </div>

            <div class="create__item">
                <label for="instruction">Instruction: </label>
                <section class="wrapper-border flex-box">
                    <ol class="list" id="instruction">
                        <?php getRecipeArray("instruction") ?>
                    </ol>
                    <section class="button-container flex-box">
                        <div class="create-list button" onclick="createList('instruction')">
                            Create List
                        </div>
                        <div class="copy button" onclick="copyConfigure('instruction')">
                            Copy
                        </div>
                        <div class="delete-all button" onclick="deleteAllFunction('instruction')">
                            Delete All
                        </div>
                    </section>
                </section>
            </div>

            <div class="flex-box button-container">
                <input type="submit" value="<?php echo $state ?>" class="create-button button button--white-hover" name="<?php echo $state ?>">
                <?php deleteButton($state) ?>
            </div>
        </form>

        <div class="copy-background none flex-box flex-center">
            <section class="copy-window flex-box">
                <h1 class="">Copy</h1>
                <textarea id="copy" class="copy-value flex-grow"></textarea>
                <button onclick="copyFunction()" class="copy-button button">Copy</button>
            </section>
        </div>
    </main>

    <script src="../js/create.js"></script>
</body>

</html>

<?php $conn->close() ?>

<?php

function formMethod(): void
{
    if (isset($_GET['create'])) createRecipe();
    if (isset($_GET['edit'])) editRecipe();
    if (isset($_GET['delete'])) deleteRecipe();
}

function getInput(): array | null
{
    $inputArray = array();
    $inputArray['title'] = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $inputArray['desc'] = filter_input(INPUT_GET, 'desc', FILTER_SANITIZE_SPECIAL_CHARS);
    $inputArray['ingredients'] = json_encode($_GET["ingredients"]);
    $inputArray['instruction'] = json_encode($_GET["instruction"]);
    $inputArray['author'] = getUserData('username');

    if (empty($inputArray['title'])) {
        sendError("You haven't enter your title!");
        return null;
    }

    return $inputArray;
}

function createRecipe(): void
{
    $inputValue = getInput();
    if (empty($inputValue)) return;
    extract($inputValue);

    global $conn;
    $sql = "INSERT INTO recipes (author, title, description, ingredients, instruction)
            VALUES ('$author', '$title', '$desc', '$ingredients', '$instruction');";

    $conn->query($sql);
    $sql = "INSERT INTO recipes_stats () VALUES ()";
    $conn->query($sql);
    header("Location: home.php");
}

function editRecipe(): void
{
    $inputValue = getInput();
    if (empty($inputValue)) return;
    extract($inputValue);

    $id = getRecipe('id');
    global $conn;
    $sql = "UPDATE recipes SET author='$author', title='$title', description='$desc', 
            ingredients='$ingredients', instruction='$instruction' WHERE id='$id'";
    $conn->query($sql);

    unset($_SESSION['edit_recipe']);
    header("Location: home.php");
}

function deleteRecipe(): void
{
    global $conn;
    $id = getRecipe("id");
    $sql = "DELETE FROM recipes WHERE id='$id'";
    $conn->query($sql);
    header("Location: home.php");
}

function getState(): string
{
    if (isset($_POST['editRecipe'])) return "edit";
    return "create";
}

function getRecipe(string $key): mixed
{
    global $editRecipeData;
    if (empty($editRecipeData[$key])) return null;
    return $editRecipeData[$key];
}

function getRecipeArray(string $key): void
{
    if (empty(getRecipe($key))) return;
    $container = $key;
    foreach(json_decode(getRecipe($key)) as $text) {
        include('../template/recipe-list.php');
    }
}

function getEditRecipeData(string $state): array | null
{
    if ($state === 'create') return null;
    $recipeId = $_POST['recipeId'];
    global $conn;
    $sql = "SELECT * FROM recipes WHERE id='$recipeId'";
    return $conn->query($sql)->fetch_assoc();
}

function deleteButton(string $state): void
{
    if ($state != 'edit') return;
    echo 
    "
    <input type='submit' value='delete' name='delete' class='create-button delete-button button'>
    ";
}

?>