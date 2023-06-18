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
                    <ul class="list" id="ingredients"></ul>
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
                    <ol class="list" id="instruction"></ol>
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

            <div>
                <input type="submit" value="Create" class="create-button button button--white-hover" name="create">
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

    <script>
        const configureFunction = () => {
            document.querySelectorAll("textarea").forEach((textArea) => {
                textArea.style.height = "";
                textArea.style.height = textArea.scrollHeight + "px";

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

        const createList = (containerName, value = "") => {
            let li = document.createElement("li");
            li.classList.add("textarea-wrapper");

            let div = document.createElement("div");
            div.classList.add("wrapper-grid");

            let textarea = document.createElement("textarea");
            textarea.setAttribute("name", containerName + "[]");
            textarea.setAttribute("rows", "1");
            textarea.value = value;

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

        const copyConfigure = (containerName) => {
            let copyBackground = document.querySelector(".copy-background");
            copyBackground.classList.toggle("none");
            copyBackground.setAttribute("container", containerName);
            document.querySelector("#copy").value = "";
        }

        const copyFunction = () => {
            let containerName = document.querySelector(".copy-background").getAttribute('container');
            let value = document.querySelector('#copy').value.split("\n");
            console.log(containerName);
            value.forEach(string => createList(containerName, string));
            copyConfigure();
        }

        const deleteAllFunction = (containerName) => {
            let container = document.getElementById(containerName);
            while (container.firstChild) {
                container.removeChild(container.firstChild);
            }
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

    $ingredients = json_encode($_GET["ingredients"]);
    $instruction = json_encode($_GET["instruction"]);


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