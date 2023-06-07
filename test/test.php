<form action="<? $_SERVER['PHP_SELF'] ?>" method="get">
    <input type="submit" value="test">
</form>

<?php
session_start();
$_SESSION['test'] = "Hello World";
header("Location: test2.php");

?>