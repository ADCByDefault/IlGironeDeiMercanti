<!DOCTYPE html>
<html>
<head>
    <title>Error 500 - Internal Server Error</title>
</head>
<body>
    <h1>Error 500 - Internal Server Error</h1>
    <p>Sorry, something went wrong on the server.</p>
</body>
</html>

<?php
session_start();
if (isset($_SESSION["error"])) {
    header("Location: index.php");
} else {
    $_SESSION["error"] = "Internal server error";
    header("Location: index.php");
}
die();
