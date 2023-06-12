<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="">
        <textarea name="textareaName"></textarea>
        <button type="submit">Submit</button>
    </form>
</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve textarea value from form
    $textareaValue = $_POST["textareaName"];

    // Replace line breaks with <br> tags
    $textareaValueWithBr = nl2br($textareaValue);

    $array = explode("\n", $textareaValue);
    print_r($array);
}

?>