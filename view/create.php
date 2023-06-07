<?php include("../template/home-head.php") ?>
<link rel="stylesheet" href="../css/create.css?v=<?php echo time() ?>">
<title>Create</title>
</head>

<body>
    <?php include("../template/header.php") ?>


    <main class="container">
        <h1 class="title">Create New Repository</h1>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" class="create" method="get">

            <?php getGetMethod(); ?>

            <div class="create__item">
                <label for="title">Title: </label>
                <input type="text" name="title">
            </div>
            <div class="create__item">
                <label for="desc">Description: </label>
                <textarea rows=1 name="desc"></textarea>
            </div>
            <div class="create__item">
                <label for="ingredients">Ingredients: </label>
                <textarea rows=1 name="ingredients"></textarea>
            </div>
            <div class="create__item">
                <label for="instruction">Instruction: </label>
                <textarea rows=1 name="instruction"></textarea>
            </div>

            <div>
                <input type="submit" value="Create" class="create-button button button--white-hover">
            </div>
        </form>
    </main>

    <script>
        const textAreaContainer = document.querySelectorAll("textarea")
        textAreaContainer.forEach((textArea) => {
            textArea.oninput = () => {
                textArea.style.height = "";
                textArea.style.height = textArea.scrollHeight + "px";
            }
        })
    </script>
</body>

</html>

<?php 

function getGetMethod():void
{
    if ($_SERVER['REQUEST_METHOD'] != "GET" and
        isset($_GET['submit'])) return;

    foreach($_POST as $key => $value) {
        echo "{$key} = {$value} <br>";
    }

    $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $desc = filter_input(INPUT_GET, 'desc', FILTER_SANITIZE_SPECIAL_CHARS);
    $ingredients = filter_input(INPUT_GET, 'ingredients', FILTER_SANITIZE_SPECIAL_CHARS);
    $instruction = filter_input(INPUT_GET, 'instruction', FILTER_SANITIZE_SPECIAL_CHARS);
    

    if (empty($title)) {
        sendError("You haven't enter your title!");
        return;
    }

    $conn = getConn();
    $author = getUserData('username');
    $sql = "INSERT INTO recipes (author, title, description, ingredients, instruction)
            VALUES ('$author', '$title', '$desc', '$ingredients', '$instruction');";
    $conn->query($sql);
    $conn->close();

    header("Location: home.php");
}

?>