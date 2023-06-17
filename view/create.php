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
                <section class="wrapper-border flex-box">
                    <ul class="list" id="ingredients">
                        <li class="textarea-wrapper">
                            <div class="wrapper-grid">
                                <textarea name="ingredients[]" rows="1"></textarea>
                                <img class="delete button" src="../img/trash.ico" height="32" width=32>
                            </div>
                        </li>
                    </ul>
                    <div class="create-list button" onclick="createList('ingredients')">
                        Create List
                    </div>
                </section>
            </div>

            <div class="create__item">
                <label for="instruction">Instruction: </label>
                <section class="wrapper-border flex-box">
                    <ol class="list" id="instruction">
                        <li class="textarea-wrapper">
                            <div class="wrapper-grid">
                                <textarea name="instruction[]" rows="1"></textarea>
                                <img class="delete button" src="../img/trash.ico" height="32" width=32>
                            </div>
                        </li>
                    </ol>
                    <div class="create-list button" onclick="createList('instruction')">
                        Create List
                    </div>
                </section>
            </div>

            <div>
                <input type="submit" value="Create" class="create-button button button--white-hover" name="create">
            </div>
        </form>
    </main>

    <script>
        const configureFunction = () => {
            document.querySelectorAll("textarea").forEach((textArea) => {
                textArea.oninput = () => {
                    textArea.style.height = "";
                    textArea.style.height = textArea.scrollHeight + "px";
                }
            })

            document.querySelectorAll(".delete").forEach(deleteButton => {
                deleteButton.addEventListener("click", (event) => {
                    deleteButton.parentElement.parentElement.remove();
                })
            })
        }

        const createList = (containerName) => {
            let li = document.createElement("li");
            li.classList.add("textarea-wrapper");

            let div = document.createElement("div");
            div.classList.add("wrapper-grid");

            let textarea = document.createElement("textarea");
            textarea.setAttribute("name", containerName + "[]");
            textarea.setAttribute("rows", "1");

            let deleteButton = document.createElement("img");
            deleteButton.setAttribute("src", "../img/trash.ico");
            deleteButton.setAttribute("width", "32");
            deleteButton.setAttribute("height", "32");
            deleteButton.classList.add("delete", "button");

            div.appendChild(textarea);
            div.appendChild(deleteButton);
            li.appendChild(div);

            document.getElementById(containerName).appendChild(li);
            configureFunction();
        }

        configureFunction();
    </script>
</body>

</html>

<?php

function getGetMethod(): void
{
    if (empty($_GET['create'])) return;

    $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
    $desc = filter_input(INPUT_GET, 'desc', FILTER_SANITIZE_SPECIAL_CHARS);

    $ingredients = $_GET['ingredients'];
    $instruction = $_GET['instruction'];

    $ingredients = str_replace("\n", "<br>", $ingredients);
    $ingredients = str_replace("\r", " ", $ingredients);
    $ingredients = explode("<br>", $ingredients);
    $ingredients = json_encode($ingredients);

    $instruction = str_replace("\n", "<br>", $instruction);
    $instruction = str_replace("\r", " ", $instruction);
    $instruction = explode("<br>", $instruction);
    $instruction = json_encode($instruction);

    echo gettype($instruction);

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