<?php
include_once "authentication/connessione.php";
include_once "class/Response.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <script src="index.js" defer></script>
    <link rel="stylesheet" href="index.css">
</head>

<body>
    <nav class="navbar bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-light">Il Girone <br>dei Mercanti
            </a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search">
                <button class="btn btn-outline-success text-light" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <?php
    $user_id = null;
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
    }
    if (!$user_id) {
        echo "
                <p>skibidi Toilet</p>
                <p><a href=\"authentication/login.html\">login</a></p>
                <p><a href=\"authentication/signup.html\">singup</a></p>
            ";
    } else {
        echo "<p><a href=\"authentication/logout.php\">logout</a></p>";
        echo "<p><a href=\"dashboard/dashboard.php\">dashboard</a></p>";
    }
    ?>
    <main>
        <div class="error-container" id="errorContainer"></div>
        <div class="articles-container" id="articlesContainer"></div>
    </main>
</body>

</html>