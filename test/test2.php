<!DOCTYPE html>
<html>
<head>
    <title>Enter Key Press Detection</title>
    <script>
        function detectEnterKeyPress(event) {
            if (event.keyCode === 13) {
                event.preventDefault(); // Prevent form submission
                alert("Enter key pressed!");
                // Additional code for handling the Enter key press
            }
        }
    </script>
</head>
<body>
    <form method="post" action="">
        <input type="text" onkeydown="detectEnterKeyPress(event)">
        <button type="submit">Submit</button>
    </form>
</body>
</html>