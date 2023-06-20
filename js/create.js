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