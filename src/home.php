<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
        <h1>
            Il Gran Girone Dei Mercanti
        </h1>
    </header>
    <?php
    if (isset($_SESSION["error"])) {
        echo "<p>" . $_SESSION["error"] . "</p>";
    }
    ?>
    <?php
    unset($_SESSION["error"]);
    ?>
    <div>
        <a href="authentication/login.html">go to login</a>
    </div>
    <div>
        <a href="authentication/signup.html">go to signup</a>
    </div>
</body>

</html>